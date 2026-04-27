@extends('layouts.app')

@section('content')
<h1>Оформление заказа</h1>

<div style="display:flex; gap:30px;">
    <div style="flex:1;">
        <h3>Товары</h3>
        @foreach($cartItems as $item)
        <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #ddd;">
            <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
            <span>{{ number_format($item->quantity * $item->product->price, 0, '.', ' ') }} ₽</span>
        </div>
        @endforeach
        <h3 style="margin-top:20px;">Общая стоимость: {{ number_format($total, 0, '.', ' ') }} ₽</h3>
    </div>
    
    <div style="flex:1;">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom:15px;">
                <label>Выбрать курьера</label>
                <select name="courier_id" required style="width:100%; padding:10px;">
                    @foreach($couriers as $courier)
                    <option value="{{ $courier->id }}">{{ $courier->name }} ({{ $courier->phone }})</option>
                    @endforeach
                </select>
            </div>
            
            <div style="margin-bottom:15px;">
                <label>Время доставки</label>
                <input type="text" name="delivery_time" required placeholder="Например: 19:00" style="width:100%; padding:10px;">
            </div>
            
            <div style="margin-bottom:15px;">
                <label>Адрес</label>
                <input type="text" name="address" required placeholder="Улица, дом" style="width:100%; padding:10px;">
            </div>
            
            <div style="margin-bottom:15px;">
                <label>Подъезд</label>
                <input type="text" name="entrance" style="width:100%; padding:10px;">
            </div>
            
            <div style="margin-bottom:15px;">
                <label>Квартира</label>
                <input type="text" name="apartment" style="width:100%; padding:10px;">
            </div>
            
            <div style="margin-bottom:15px;">
                <label>Этаж</label>
                <input type="text" name="floor" style="width:100%; padding:10px;">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width:100%;">Заказать</button>
        </form>
    </div>
</div>
@endsection