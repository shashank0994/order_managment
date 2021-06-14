<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-page">
    <header class="py-4 flex items-center z-30 w-full">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <div class="uppercase text-gray-800 dark:text-white font-black text-3xl">Order Management</div>
            <div class="flex items-center">
                <nav class="font-sen text-gray-800 dark:text-white uppercase text-lg lg:flex items-center hidden">
                    <a href="{{secure_url('products')}}" class="py-2 px-6 flex">Home</a>
                    <a href="{{secure_url('cart')}}" class="py-2 px-6 flex">Cart</a>
                    <a href="{{secure_url('orders')}}" class="py-2 px-6 flex">Orders</a>
                </nav>
            </div>
        </div>
    </header>
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</div>

@stack('modals')
<script src="{{ mix('js/app.js') }}" ></script>
</body>
</html>
