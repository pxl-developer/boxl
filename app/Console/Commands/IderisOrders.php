<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Sku;
use DomainException;
use ErrorException;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
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
        $iderisOrders = Ideris::get('/order/search',[
            'statusId' => 1007
        ])->object();
        
        if ( !$iderisOrders ){
            exit;
        }
        
        foreach ( $iderisOrders->obj as $orders ){
            
            $iderisOrder = Ideris::get('/order/'.$orders->id)->object()->obj;

            $userData = User::where('authentication_id', $iderisOrder->authenticationId)->get()->first();

            if ( !$userData ){
                continue;
            }
            
            if( $iderisOrder->itemsCost == 0 ){
                foreach($iderisOrder->items as $item){
                    $itemBD = Sku::where('sku', $item->sku)->get()->first();
                    
                    $iderisOrder->itemsCost = $itemBD->cost;
                }
            }
            
            try {
                Order::create([
                    'code' => $iderisOrder->id,
                    'pack_id' => $iderisOrder->packId,
                    'order_status' => $iderisOrder->statusDescription,
                    'order_total_paid' => $iderisOrder->totalAmount,
                    'order_fee' => $iderisOrder->feeOrder,
                    'order_cost' => $iderisOrder->itemsCost,
                    'delivery_type' => $iderisOrder->deliveryType,
                    'user_id' => $userData->id
                ]);
                
                $updateData = array(
                    'orderId' => $iderisOrder->id,
                    'statusId' => 1337,
                );
                
                Ideris::put('/order',$updateData);
            } catch (QueryException) {
                continue;
            }
        }
    }
}
