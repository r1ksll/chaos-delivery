@extends('layouts.app')

@section('content')
<h1>Добавить товар</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    
    <div style="margin-bottom:15px;">
        <label>Ресторан</label>
        <select name="restaurant_id" required style="width:100%; padding:10px;">
            @foreach($restaurants as $restaurant)
            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Категория</label>
        <select name="category_id" required style="width:100%; padding:10px;">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Название</label>
        <input type="text" name="name" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Описание</label>
        <textarea name="description" style="width:100%; padding:10px;" rows="3"></textarea>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Вес (граммы)</label>
        <input type="number" name="weight" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Цена (₽)</label>
        <input type="number" name="price" step="0.01" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Картинка</label>
        <input type="file" name="image" accept="image/*" style="width:100%; padding:10px;">
        <small>Поддерживаются: jpeg, png, jpg, gif. Максимум 20MB</small>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection