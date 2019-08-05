<?php

namespace APIRestful\Transformers;

use APIRestful\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identificador' => (int)$seller->id,
            'nombre' => (string)$seller->name,
            'correo' => (string)$seller->email,  
            'esVerificado' => (int)$seller->verified,
            'fechaCreacion' => (string)$seller->created_at,
            'fechaActualizacion' => (string)$seller->updated_at,
            'fechaEliminacion' => isset($seller->deleted_at) ? (string) $seller->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('sellers.show', $seller->id),
                ],
                [
                    'rel' => 'sellers.transactions', 
                    'href' => route('sellers.transactions.index', $seller->id)
                ],
                [
                    'rel' => 'sellers.categories', 
                    'href' => route('sellers.categories.index', $seller->id)
                ],
                [
                    'rel' => 'sellers.buyers', 
                    'href' => route('sellers.buyers.index', $seller->id)
                ],
                [
                    'rel' => 'sellers.products', 
                    'href' => route('sellers.products.index', $seller->id)
                ],
                [
                    'rel' => 'user', 
                    'href' => route('users.show', $seller->id)
                ],
            ],
        ];
    }

    //Función para mapear los valores originales de la bd
    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'email',  
            'esVerificado' => 'verified',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
