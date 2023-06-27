<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Ideris;

class IderisOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ideris:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $getOrders = Ideris::get('/order/search',[
            'statusId' => 1007
        ]);

        if ( ! $getOrders->ok() ){
            $this->error('Não foi possível receber os pedidos');
            die;
        }
        
        foreach ( $getOrders->object()->obj as $orders ){
            
            $getInfos = Ideris::get('/order/'.$orders->id)->object()->obj;
            
            $userData = User::where('authenticationId', $getInfos->authenticationId)->first();
            
            if ( $userData == null){
                $this->error('Vendedor não cadastrado');
                continue;
            }

            $code = $getInfos->id;
            
            if ( Order::where('code', $code)->count() >= 1 ){
                $this->error('Erro ao gerar pedido');
                continue;
            }
            
            if ( $getInfos->deliveryType == 'FLEX' ){
                $orderFee = 15.90;
            }else{
                $orderFee = 0;
            }

            Order::create([
                'code' => $code,
                'order_status' => $getInfos->statusDescription,
                'order_total_paid' => $getInfos->paidAmount,
                'order_fee' => $orderFee,
                'order_cost' => $getInfos->itemsCost,
                'id_user' => $userData->id,
            ]);

            $this->info('Pedidos inseridos com êxito');
        }
    }
}
