@extends('layouts.app')

@section('content')
<h1>Редактировать товар</h1>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom:15px;">
        <label>Ресторан</label>
        <select name="restaurant_id" required style="width:100%; padding:10px;">
            @foreach($restaurants as $restaurant)
            <option value="{{ $restaurant->id }}" {{ $product->restaurant_id == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Категория</label>
        <select name="category_id" required style="width:100%; padding:10px;">
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Название</label>
        <input type="text" name="name" value="{{ $product->name }}" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Описание</label>
        <textarea name="description" style="width:100%; padding:10px;" rows="3">{{ $product->description }}</textarea>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Вес (граммы)</label>
        <input type="number" name="weight" value="{{ $product->weight }}" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Цена (₽)</label>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" required style="width:100%; padding:10px;">
    </div>
    
    @if($product->image)
    <div style="margin-bottom:15px;">
        <label>Текущая картинка</label><br>
        <img src="{{ asset($product->image) }}" style="max-width:200px; border-radius:10px;">
    </div>
    @endif
    
    <div style="margin-bottom:15px;">
        <label>Новая картинка (оставьте пустым, если не менять)</label>
        <input type="file" name="image" accept="image/*" style="width:100%; padding:10px;">
    </div>
    
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection