@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center;">
    <h1>Товары</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Добавить</a>
</div>

<table style="width:100%; background:white; border-radius:10px; overflow:hidden; margin-top:20px;">
    <thead>
        <tr style="background:#1a1a2e; color:white;">
            <th style="padding:10px;">ID</th>
            <th>Название</th>
            <th>Ресторан</th>
            <th>Категория</th>
            <th>Цена</th>
            <th>Вес</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->restaurant->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ number_format($product->price, 0, '.', ' ') }} ₽</td>
            <td>{{ $product->weight }} г</td>
            <td>
                <a href="{{ route('admin.products.edit', $product->id) }}" style="margin-right:10px;">Редактировать</a>
                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none; border:none; cursor:pointer;">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection