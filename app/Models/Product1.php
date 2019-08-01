<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product1 extends Model
{
    protected  $table = 'product11';
    protected $fillable = [
        'name', 'slug', 'description', 'quantity', 'price', 'promotional',
        'idCategory', 'idProductType', 'status',
    ];

    public function productTypes(){
        return $this->belongsTo('App\Models\ProductTypes','idProductType','id');
    }
    public function categories(){
        return $this->belongsTo('App\Models\Categories','idCategory','id');
    }
}
