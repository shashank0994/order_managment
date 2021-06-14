@extends('layouts.app')
@section('content')
<div class="h-screen bg-gray-300" x-data="{checkout:false}">
    <div class="py-12">
        <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
            <div class="md:flex ">
                <div class="w-full p-4 px-5 py-5">
                    <div class="md:grid md:grid-cols-3 gap-2 ">
                        <div class="col-span-2 p-5">
                            <h1 class="text-xl font-medium ">Shopping Cart</h1>
                            @forelse($carts as $cart)
                                <div class="flex justify-between items-center mt-6 pt-6 @if(!$loop->first) border-t @endif">
                                    <div class="flex items-center"> <img src="{{secure_url('storage/'.$cart->product->image)}}" width="60" class="rounded-full ">
                                        <div class="flex flex-col ml-3"> <span class="md:text-md font-medium">{{$cart->product->name}}</span> <span class="text-xs font-light text-gray-400">#{{$cart->id}}</span> </div>
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <div class="pr-8 flex flex-col items-center">
                                            <div class="flex items-center">
                                                <form action="{{secure_url('edit-cart/'.$cart->id.'/minus')}}" method="post">
                                                    @csrf
                                                    <x-button type="submit"><span class="font-semibold">-</span></x-button>
                                                </form>
                                                <div class="focus:outline-none bg-gray-100 border h-6 w-8 rounded text-sm px-2 mx-2">
                                                    {{$cart->qty}}
                                                </div>
                                                <form action="{{secure_url('edit-cart/'.$cart->id.'/add')}}" method="post">
                                                    @csrf
                                                    @if($cart->product->availability >= $cart->qty+1)
                                                        <x-button type="submit"><span class="font-semibold">+</span></x-button>
                                                    @else
                                                        <x-button type="button" disabled><span class="font-semibold">+</span></x-button>
                                                    @endif
                                                </form>
                                            </div>
                                            <p>Available:{{$cart->product->availability - $cart->qty}}</p>
                                        </div>
                                        <div class="pr-8 "> <span class="text-xs font-medium">₹{{$cart->price * $cart->qty}}</span> </div>
                                        <div> <i class="fa fa-close text-xs font-medium"></i> </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-4 text-2xl">
                                    No products in cart
                                </div>
                            @endforelse
                            <div class="flex justify-between items-center mt-6 pt-6 border-t">
                                <div class="flex items-center"><a href="{{secure_url('products')}}"> <span class="text-md font-medium text-blue-500">Continue Shopping</span></a> </div>
                                <div class="flex justify-center items-center"> <span class="text-sm font-medium text-gray-400 mr-1">Subtotal:</span> <span class="text-lg font-bold text-gray-800 "> ₹{{$carts->sum(function ($cartItem){ return $cartItem->price * $cartItem->qty;})}}</span> </div>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between p-5 bg-gray-800 rounded overflow-visible">
                            <div>
                                <span class="text-xl font-medium text-gray-100 block pb-3">Payment Options</span>
                                <div class="pb-5 border-b-2 border-gray-300">
                                    <label class="text-white text-lg" for="cod">
                                        <input id="cod" type="radio" class="mr-1" checked name="payment_option" value="cod">
                                        COD
                                    </label>
                                </div>
                                <div class="py-5 border-b-2 border-gray-300">
                                    <label class="text-white text-lg" for="online">
                                        <input id="online" type="radio" class="mr-1" name="payment_option" value="cod">
                                        Online
                                    </label>
                                </div>
                            </div>
                            <button onclick="showModal()" {{$carts->count() <= 0 ? 'disabled' : ''}} type="button" class="h-12 w-full bg-blue-500 mt-5 rounded focus:outline-none text-white hover:bg-blue-600">Check Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal" class="top-0 left-0 hidden absolute w-full h-screen bg-opacity-50 flex items-center justify-center z-50 bg-gray-100">
        <div class="w-11/12 md:w-1/3 py-3 rounded-sm bg-white text-center shadow-lg">
            <p class="text-lg py-4">This is a demo application, choose an option</p>
            <div class="flex justify-between mx-4">
                <form action="{{secure_url('order/success')}}" method="post">
                    @csrf
                    <x-button type="submit">Success</x-button>
                </form>
                <form action="{{secure_url('order/failure')}}" method="post">
                    @csrf
                    <x-button type="submit">Failure</x-button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function showModal(){
        document.getElementById('modal').classList.toggle('hidden');
    }
</script>
@endsection
