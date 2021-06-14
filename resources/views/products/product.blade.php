@extends('layouts.app')

@section('content')
    <div class="container my-12 mx-auto px-4 md:px-12">
        <h1 class="text-center text-2xl mb-10 font-bold uppercase">Products</h1>
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach($products as $product)
                <!-- Column -->
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg">
                        <img alt="{{$product->name}}" class="block m-auto h-auto" src="{{asset('storage/'.$product->image)}}">
                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="#">
                                    {{$product->name}}
                                </a>
                            </h1>
                            <div class="">
                                @if($product->availability > 0)
                                    <form action="{{secure_url('cart/'.$product->id)}}" method="post">
                                        @csrf
                                        @if($product->cart_info_count <= 0)
                                            <x-button type="submit">
                                                <span class="flex items-center space-x-2">
                                                    Add
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                </span>
                                            </x-button>
                                        @else
                                            <x-nav-link href="{{secure_url('cart')}}">View Cart</x-nav-link>
                                        @endif
                                    </form>
                                @else
                                    <x-button type="button" disabled>Out of Stock</x-button>
                                @endif
                            </div>
                        </header>
                    </article>
                    <!-- END Article -->

                </div>
                <!-- END Column -->
            @endforeach
        </div>
    </div>
@endsection
