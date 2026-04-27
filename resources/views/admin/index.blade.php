@extends('layouts.app')

@section('content')
<h1>Админ-панель</h1>

<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-top:30px;">
    <a href="{{ route('admin.users') }}" style="background:#e94560; color:white; padding:30px; text-align:center; text-decoration:none; border-radius:10px;">
        <h2> Пользователи</h2>
    </a>
    <a href="{{ route('admin.restaurants') }}" style="background:#e94560; color:white; padding:30px; text-align:center; text-decoration:none; border-radius:10px;">
        <h2> Рестораны</h2>
    </a>
    <a href="{{ route('admin.categories') }}" style="background:#e94560; color:white; padding:30px; text-align:center; text-decoration:none; border-radius:10px;">
        <h2> Категории</h2>
    </a>
    <a href="{{ route('admin.products') }}" style="background:#e94560; color:white; padding:30px; text-align:center; text-decoration:none; border-radius:10px;">
        <h2> Товары</h2>
    </a>
    <a href="{{ route('admin.couriers') }}" style="background:#e94560; color:white; padding:30px; text-align:center; text-decoration:none; border-radius:10px;">
        <h2> Курьеры</h2>
    </a>
</div>
@endsection