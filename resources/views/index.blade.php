@extends('layouts.app')

@section('content')
   
    <div class="banner">
        <img src="{{ asset('images/1.jpg') }}" alt="Баннер" style="width:100%; border-radius:10px; margin:20px 0;">
    </div>

    
    <h2>Рестораны</h2>
    <div class="restaurants-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin:20px 0;">
        @foreach($restaurants as $restaurant)
            <div class="restaurant-card" onclick="location.href='{{ route('restaurant', $restaurant->id) }}'" style="background:white; border-radius:10px; overflow:hidden; cursor:pointer; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <img src="{{ $restaurant->image ?? 'https://via.placeholder.com/300x200/cccccc/666666?text='.urlencode($restaurant->name) }}" style="width:100%; height:150px; object-fit:cover;">
                <div style="padding:15px; text-align:center; font-weight:bold;">{{ $restaurant->name }}</div>
            </div>
        @endforeach
    </div>

    
    <h2>Категории</h2>
    <div class="categories" style="display:flex; gap:15px; flex-wrap:wrap; margin:20px 0;">
        @foreach($categories as $category)
            <a href="{{ route('category', $category->slug) }}" style="background:#e94560; color:white; padding:10px 25px; border-radius:25px; text-decoration:none;">{{ $category->name }}</a>
        @endforeach
    </div>

    
    <h2>Меню</h2>
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card" onclick="location.href='{{ route('product', $product->id) }}'">
                <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200/cccccc/666666?text='.urlencode($product->name) }}" alt="{{ $product->name }}">
                <div class="info">
                    <div class="name">{{ $product->name }}</div>
                    <div class="price">{{ number_format($product->price, 0, '.', ' ') }} ₽</div>
                    <div style="font-size:12px; color:#888;">{{ $product->restaurant->name }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection