@extends('layouts.app')

@section('content')
    <div class="restaurant-page">
        <img src="{{ $restaurant->image ?? 'https://via.placeholder.com/1200x300/1a1a2e/e94560?text='.urlencode($restaurant->name) }}" style="width:20%; border-radius:10px; margin:20px 0;">
        
        <h1>{{ $restaurant->name }}</h1>
        
        <h2>Меню</h2>
        <div class="products-grid">
            @foreach($restaurant->products as $product)
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
    </div>
@endsection