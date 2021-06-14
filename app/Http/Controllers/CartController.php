<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart_list(){
        $carts = Cart::with('product')->where('session_id',session('_token'))->get();
        return view('cart.list',compact('carts'));
    }

    public function save_cart($product_id,Request $request){
        $product = Product::find($product_id);
        if($product->availability > 0){
            if(isset($product)){
                Cart::create([
                    'product_id'=>$product_id,
                    'price'=>$product->price,
                    'session_id'=>session('_token')
                ]);
            }
            return redirect('cart');
        }else{
            session()->flash('fail','Sorry, stock is not available');
            return redirect('products');
        }
    }

    public function edit_cart($cart_id,$action,Request $request){
        $cart = Cart::where('session_id',session('_token'))->where('id',$cart_id)->first();
        if(isset($cart)){
            if($action == 'add'){
                $sold_count = Order::where('product_id',$cart->product_id)->where('status',2)->count();
                if($cart->product->availability >= $cart->qty+1){
                    $cart->qty = $cart->qty + 1;
                    $cart->save();
                }else{
                    session()->flash('fail','Sorry, stock is not available');
                }
            }elseif($action == 'minus'){
                if($cart->qty == 1){
                    $cart->delete();
                }else{
                    $cart->qty = $cart->qty -1;
                    $cart->save();
                }
            }
        }
        return redirect('cart');
    }
}
