@extends('layouts.app')
@section('content')
    <div class="bg-gray-300" x-data="{checkout:false}">
        <div class="py-12 ">
            <div class="flex max-w-md mx-auto mb-4 md:max-w-5xl">
                <input value="{{request()->get('order_number') ?? ''}}" type="search" name="order_number" class="w-1/2 mr-2 rounded-md px-2" placeholder="Enter order number to search">
                <x-button type="button" onclick="searchOrder(this)">Search</x-button>
                @if(request()->has('order_number'))
                    <x-nav-link class="ml-2" href="{{secure_url('orders')}}">reset</x-nav-link>
                @endif
            </div>
            <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
                <div class="md:flex ">
                    <div class="w-full p-4 px-5 py-5">
                        <div class="block w-full">
                            <div class="col-span-2 p-5">
                                <h1 class="text-xl font-medium">Orders</h1>
                                @foreach($orders as $order_number=>$groupedOrder)
                                    <div>
                                        <div class="flex justify-between mb-1 mt-5">
                                            <span>#{{$order_number}}</span>
                                            <span class="flex">
                                                @if($groupedOrder->first()->status == 2)
                                                    success
                                                @elseif($groupedOrder->first()->status == 3)
                                                    <form action="{{secure_url('retry/payment/'.$order_number)}}" method="post">
                                                        @csrf
                                                        failure <x-button type="submit">Retry</x-button>
                                                    </form>
                                                @else
                                                    pending
                                                @endif
                                            </span>
                                            <span>₹{{$groupedOrder->sum('total_price')}}</span>
                                            <span>{{\Carbon\Carbon::parse($groupedOrder->first()->created_at)->format('d-m-Y')}}</span>
                                        </div>
                                        <div class="py-2 px-3 border-2 w-full">
                                            @foreach($groupedOrder as $eachOrder)
                                                <div class="flex justify-between items-center py-3 @if(!$loop->first) border-t @endif">
                                                    <div class="flex items-center"> <img src="{{secure_url('storage/'.$eachOrder->product->image)}}" width="60" class="rounded-full ">
                                                        <div class="flex flex-col ml-3"> <span class="md:text-md font-medium">{{$eachOrder->product->name}}</span> <span class="text-xs font-light text-gray-400">#{{$eachOrder->id}} ({{$eachOrder->qty}} Qty)</span> </div>
                                                    </div>
                                                    <div class="flex justify-center items-center">

                                                        <div class="pr-8 "> <span class="text-xs font-medium">₹{{$eachOrder->total_price}}</span> </div>
                                                        <div> <i class="fa fa-close text-xs font-medium"></i> </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function searchOrder(t){
            const orderNumber = document.getElementsByName('order_number')[0].value;
            if(orderNumber.length > 0){
                window.location.href = '/orders?order_number='+orderNumber;
            }
        }
    </script>
@endsection
