<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
      'product_id','qty','total_price','order_number','session_id','status' // 1 => Pending; 2 => Success; 3 => Failure;
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
