<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'product_img',
        'product_name',
        'price',
        'product_ingredients',
        'quantity',
    ];

    public function scopeFilter($query, $filters)
    {
        if (! $filters) {
            return $query;
        }

        $query = $query->where(function($query) use ($filters) {
            foreach($filters as $field => $value) {
                if (isset($value)) {
                    if ($field == 's') {
                        $query->orWhere('product_name', 'like', '%' . $value . '%')
                              ->orWhere('product_ingredients', 'like', '%' . $value . '%');
                    } else {
                        $query->where($field, $value);
                    }
                }
            }
        });
        
        return $query;
    }
}
