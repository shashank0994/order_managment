<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_list(){
        $products = Product::withCount(['cartInfo'])->get();
        return view('products.product',compact('products'));
    }
}
