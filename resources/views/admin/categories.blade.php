@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center;">
    <h1>Категории</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Добавить</a>
</div>

<table style="width:100%; background:white; border-radius:10px; overflow:hidden; margin-top:20px;">
    <thead>
        <tr style="background:#1a1a2e; color:white;">
            <th style="padding:10px;">ID</th>
            <th>Название</th>
            <th>Slug</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $category->id) }}" style="margin-right:10px;">Редактировать</a>
                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;">
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