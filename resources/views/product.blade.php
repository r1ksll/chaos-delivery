@extends('layouts.app')

@section('content')
    <div class="product-page" style="display:flex; gap:30px; background:white; padding:30px; border-radius:10px; margin:30px 0;">
        <div class="product-image" style="flex:1;">
            <img src="{{ $product->image ?? 'https://via.placeholder.com/400x400/cccccc/666666?text='.urlencode($product->name) }}" style="width:100%; border-radius:10px;">
        </div>
        <div class="product-info" style="flex:1;">
            <h1>{{ $product->name }}</h1>
            <p style="color:#666; margin:15px 0;">{{ $product->description ?? 'Состав: свежие ингредиенты, приготовлено с любовью' }}</p>
            <p style="font-size:14px; color:#888;">Вес: {{ $product->weight }} г</p>
            <p style="font-size:32px; color:#e94560; font-weight:bold; margin:20px 0;">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <input type="number" name="quantity" value="1" min="1" style="width:80px; padding:10px; margin-right:10px;">
                <button type="submit" class="btn btn-primary">Купить</button>
            </form>
        </div>
    </div>
@endsection