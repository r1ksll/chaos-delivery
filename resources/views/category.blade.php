@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>
    
    @foreach($products as $restaurantName => $restaurantProducts)
        <h2 style="margin-top:30px;">{{ $restaurantName }}</h2>
        <div class="products-grid">
            @foreach($restaurantProducts as $product)
                <div class="product-card" onclick="location.href='{{ route('product', $product->id) }}'">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200/cccccc/666666?text='.urlencode($product->name) }}">
                    <div class="info">
                        <div class="name">{{ $product->name }}</div>
                        <div class="price">{{ number_format($product->price, 0, '.', ' ') }} ₽</div>
                        <div style="font-size:12px; color:#888;">{{ $product->weight }} г</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection