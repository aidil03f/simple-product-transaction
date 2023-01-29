<?php

namespace App\Traits;

trait Product
{
    public function resultProductList($data)
    {
        foreach($data as $product){
            $results[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock,
                'description' => $product->description ? $product->description : null
            ];
        }
        return $results;
    }
}