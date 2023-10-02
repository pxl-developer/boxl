<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Ideris;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-product';

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
        $return = Ideris::get("listingModel/search")->object()->obj;

        foreach($return as $product){
            Product::create([
                'product_id' => $product->id,
                'title' => $product->title,
                'image_link' => $product->listingModelImage[0]->url,
            ]);
        }
    }
}
