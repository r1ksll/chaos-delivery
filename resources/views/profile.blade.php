@extends('layouts.app')

@section('content')
<h1>Мой профиль</h1>

<div style="background:white; padding:20px; border-radius:10px; margin-bottom:30px;">
    <p><strong>Имя:</strong> {{ $user->name }}</p>
    <p><strong>Телефон:</strong> {{ $user->phone }}</p>
    <p><strong>Email:</strong> {{ $user->email ?? 'Не указан' }}</p>
</div>

<h2>Активные заказы</h2>
@if($activeOrders->isEmpty())
    <p>Нет активных заказов</p>
@else
    @foreach($activeOrders as $order)
    <div style="background:white; padding:15px; border-radius:10px; margin-bottom:15px;">
        <p><strong>Заказ №{{ $order->id }}</strong> - {{ $order->status }}</p>
        <p>Сумма: {{ number_format($order->total_price, 0, '.', ' ') }} ₽</p>
        <p>Адрес: {{ $order->address }}</p>
        <p>Время: {{ $order->delivery_time }}</p>
        <p>Курьер: {{ $order->courier->name ?? 'Не назначен' }}</p>
    </div>
    @endforeach
@endif

<h2>История заказов</h2>
@if($historyOrders->isEmpty())
    <p>История заказов пуста</p>
@else
    @foreach($historyOrders as $order)
    <div style="background:#f5f5f5; padding:15px; border-radius:10px; margin-bottom:15px;">
        <p><strong>Заказ №{{ $order->id }}</strong> - {{ $order->status }}</p>
        <p>Сумма: {{ number_format($order->total_price, 0, '.', ' ') }} ₽</p>
        <p>Дата: {{ $order->created_at }}</p>
    </div>
    @endforeach
@endif
@endsection