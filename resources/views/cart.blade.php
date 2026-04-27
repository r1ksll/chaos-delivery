@extends('layouts.app')

@section('content')
<h1>Корзина</h1>

@if($cartItems->isEmpty())
    <p>Корзина пуста</p>
@else
    @foreach($cartItems as $item)
    <div class="cart-item">
        <div style="flex:2;">{{ $item->product->name }}</div>
        <div style="flex:1;">{{ number_format($item->product->price, 0, '.', ' ') }} ₽</div>
        <div style="flex:1;">
            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width:60px;" onchange="this.form.submit()">
            </form>
        </div>
        <div style="flex:1;">{{ number_format($item->quantity * $item->product->price, 0, '.', ' ') }} ₽</div>
        <div>
            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:#e94560; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">Удалить</button>
            </form>
        </div>
    </div>
    @endforeach
    
    <div style="text-align:right; margin-top:20px;">
        <h3>Итого: {{ number_format($total, 0, '.', ' ') }} ₽</h3>
        <a href="{{ route('checkout') }}" class="btn btn-primary" style="display:inline-block; margin-top:20px;">Оформить заказ</a>
    </div>
@endif
@endsection