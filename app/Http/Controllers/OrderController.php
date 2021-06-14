<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function order_list(){
        $order_number = \request()->get('order_number');
        if(isset($order_number)){
            $orders = Order::orderBy('created_at','desc')->where('order_number',$order_number)->get()->groupBy('order_number');
        }else{
            $orders = Order::orderBy('created_at','desc')->where('session_id',session('_token'))->get()->groupBy('order_number');
        }
        return view('order.list',compact('orders'));
    }

    public function save_order($action,Request $request){
        $carts = Cart::where('session_id',session('_token'))->get();
        $order_num = Carbon::now()->timestamp;
        foreach ($carts as $cart){
            Order::create([
               'product_id'=>$cart->product_id,
               'qty'=>$cart->qty,
               'total_price'=>$cart->qty * $cart->price,
               'order_number'=>$order_num,
               'session_id'=>session('_token'),
               'status'=>$action == 'success' ? 2 : 3
            ]);

            // Clear Cart after order is placed
            $cart->delete();

            if($action == 'success'){
                $cart->product->availability = $cart->product->availability - $cart->qty;
                $cart->product->save();
            }
        }
        return redirect('orders');
    }

    public function retry_payment($order_number,Request $request){
        Order::where('order_number',$order_number)->update(['status'=>2]);
        return redirect('orders');
    }
}
