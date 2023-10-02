{
  "sku": $product->sku, // sku do anúncio: string, obrigatório // Mkt = Todos
  "description": $product->longDescription, // descrição: string // Mkt = Todos
  "title": $product->title, // título: string, obrigatório // Mkt = Todos
  "categories": [ // array categorias do anúncio // Mkt = Todos
    {
      "code": $product->categoryId, // código: string, obrigatório // Mkt = Shopee, Meli
      "name": null, // nome: string
    }
  ],
  "images": [ //array de imagens do anúncio// Mkt = Todos
    {
      "url": $product->listingModelImage[0]->url, // url: string, obrigatório // Mkt = Shopee, Meli
      "position": null, // posição: int
    }
  ], 
  "quantity": { // objeto estoque do anúncio // Mkt = Todos
    "initialQuantity": null, // quantidade inicial: int
    "avallableQuantity": $product->quantity, // quantidade avaliada: int, obrigatório //  Mkt = Meli
  },
  "condition": 'novo', // condição do item, obrigatório: string // Mkt = Shopee, Meli
  "logistic": { obejto frete do anúncio // Mkt = Shopee
    "name": null, // nome: string, obrigatório // Mkt = Shopee, Meli
    "localPickUp": null, // retirada local: string // Mkt = Meli
    "freeShipping": null, // entrega grátis: boolean, obrigatório // Mkt = Shopee, Meli
  },
  "dimension": { objeto de dimensões do anúncio // Mkt = Shopee, Meli
    "height": $product->height, // altura: decimal, obrigatório // Mkt = Shopee, Meli (centimetros)
    "width": $product->width, // largura: decimal, obrigatório // Mkt = Shopee, Meli (centimetros)
    "length": $product->length, // comprimento: decimal, obrigatório // Mkt = Shopee, Meli (centimetros)
    "weight": $product->weight // peso: decimal, obrigatório // Mkt = Shopee, Meli (gramas)
  },
  "prices": [ //array preços do anúncio // Mkt = Todos
    {
      "price": $product->value, // valor: decimal, obrigatório // Mkt = Shopee, Meli
    }
  ],
  
  "attributes": [ //array de atributos do anúncio // Mkt = Todos
    {
      "id": null, // id: string, obrigatório // Mkt = Shopee, Meli
      "name": null, // nome do atributo valor: string, obrigatório  // Mkt = Meli
      "valueId": null, // id valor: string, obrigatório // Mkt = Shopee, Meli, Magalu
      "valueNamePt": null // descrição do valor em português: string, obrigatório // Mkt = Shopee, Meli, Magalu
      "ValueNameEn": null // descrição do valor em inglês: string // Mkt = Shopee
      }
  ],
  "variations": [ // array de variações do anúncio // Mkt = Todos
    {
      "sku": $product->variant[0]->sku, // sku da variação: string, obrigatório // Mkt = Shopee, Meli
      "quantity": $product->variant[0]->quantity, // quantidade da variação: int, obrigatório // Mkt = Shopee, Meli
      "size": null, // tamanho: decimal, obrigatório // Mkt = Meli
      "images": [ //array de imagens do anúncio // Mkt = Shopee, Meli
        {
          "url": $product->variant[0]->variantImage[0]->, // url: string, obrigatório // Mkt = Shopee, Meli
          "position": null, // posição: int
        }
      ],
      "Meli_AttributeCombinations":{
        "Meli_Id": null, // id: string, obrigatório // Mkt = Meli
        "Meli_ValueId": null, // id do valor, string, obrigatório // Mkt = Meli
        "Meli_ValueName": null, // descricao do id do valor, string, obrigatório // Mkt = Meli
      }
    }
  ],
  "meli_ListingTypeId": null, // id tipo lista: string, obrigatório // Mkt = Meli
  },
}