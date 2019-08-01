<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetail';
    protected $fillable = [
        'idOrder', 'idProduct1', 'quantity', 'price',
    ];

    public function Order(){
        return $this->belongsTo('App\Models\Order','idOrder','id');
    }
    public function Product(){
        return $this->belongsTo('App\Models\Product1','idProduct1','id');
    }
}