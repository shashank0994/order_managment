<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
      'product_id','price','qty','session_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function orders(){
        return $this->hasMany(Order::class,'product_id')->where('status',2);
    }
}
