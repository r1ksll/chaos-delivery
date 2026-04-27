@extends('layouts.app')

@section('content')
<h1>Редактировать категорию</h1>

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom:15px;">
        <label>Название</label>
        <input type="text" name="name" value="{{ $category->name }}" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Slug</label>
        <input type="text" name="slug" value="{{ $category->slug }}" required style="width:100%; padding:10px;">
    </div>
    
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection