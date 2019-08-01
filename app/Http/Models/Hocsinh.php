<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Hocsinh extends Model
{
    protected $table = 'hocsinh';
    protected $fillable = ['hoten','toan','ly','hoa'];
    public $timestamps = false;
}
