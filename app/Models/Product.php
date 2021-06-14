<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'name','price','description','brand','image','availability'
    ];

    public function cartInfo(){
        return $this->hasOne(Cart::class,'product_id')->where('session_id',session('_token'));
    }

    public function orderInfo(){
        return $this->hasMany(Order::class,'product_id')->where('status',2);
    }
}
