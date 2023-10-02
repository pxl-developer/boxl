<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;

final class Product
{
    public array $product;

    public function __construct(
        protected object $data
    ){
        $this->product = [
            "sku" => $data->sku, // sku do anúncio => string, obrigatório // Mkt = Todos
            "description" => $data->longDescription, // descrição => string // Mkt = Todos
            "title" => $data->title, // título => string, obrigatório // Mkt = Todos
            "categories" => [ // array categorias do anúncio // Mkt = Todos
                [
                    "code" => "{$data->categoryId}", // código => string, obrigatório // Mkt = Shopee, Meli
                ]
            ],
            "images" => [ //array de imagens do anúncio// Mkt = Todos
                [
                    "url" => $data->listingModelImage[0]->url, // url => string, obrigatório // Mkt = Shopee, Meli
                    "position" => 1, // posição => int
                ]
            ], 
            "quantity" => [ // objeto estoque do anúncio // Mkt = Todos
                "initialQuantity" => 1, // quantidade inicial => int
                "avallableQuantity" => $data->quantity, // quantidade avaliada => int, obrigatório //  Mkt = Meli
            ],
            "condition" => 'novo', // condição do item, obrigatório => string // Mkt = Shopee, Meli
            "logistic" => [ // obejto frete do anúncio Mkt = Shopee
                "name" => 'ml2', // nome => string, obrigatório // Mkt = Shopee, Meli
                "freeShipping" => true, // entrega grátis => boolean, obrigatório // Mkt = Shopee, Meli
            ],
            "dimension" => [ // objeto de dimensões do anúncio Mkt = Shopee, Meli
                "height" => $data->height, // altura => decimal, obrigatório // Mkt = Shopee, Meli (centimetros)
                "width" => $data->width, // largura => decimal, obrigatório // Mkt = Shopee, Meli (centimetros)
                "length" => $data->length, // comprimento => decimal, obrigatório // Mkt = Shopee, Meli (centimetros)
                "weight" => $data->weight // peso => decimal, obrigatório // Mkt = Shopee, Meli (gramas)
            ],
            "prices" => [ //array preços do anúncio // Mkt = Todos
                [
                    "price" => $data->value, // valor => decimal, obrigatório // Mkt = Shopee, Meli
                ]
            ],
            "meli_ListingTypeId" => "1",
        ];
    }
}
