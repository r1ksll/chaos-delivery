@extends('layouts.app')

@section('content')
<h1>Добавить категорию</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    
    <div style="margin-bottom:15px;">
        <label>Название</label>
        <input type="text" name="name" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Slug (например: pizza, sushi)</label>
        <input type="text" name="slug" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Картинка (путь к файлу)</label>
        <input type="text" name="image" placeholder="/images/categories/pizza.jpg" style="width:100%; padding:10px;">
        <small>Пример: /images/categories/pizza.jpg</small>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection