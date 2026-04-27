@extends('layouts.app')

@section('content')
<h1>Редактировать ресторан</h1>

<form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom:15px;">
        <label>Название</label>
        <input type="text" name="name" value="{{ $restaurant->name }}" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Город</label>
        <select name="city" required style="width:100%; padding:10px;">
            <option value="Ижевск" {{ $restaurant->city == 'Ижевск' ? 'selected' : '' }}>Ижевск</option>
            <option value="Казань" {{ $restaurant->city == 'Казань' ? 'selected' : '' }}>Казань</option>
        </select>
    </div>
    
    @if($restaurant->image)
    <div style="margin-bottom:15px;">
        <label>Текущая картинка</label><br>
        <img src="{{ $restaurant->image }}" style="max-width:200px;">
    </div>
    @endif
    
    <div style="margin-bottom:15px;">
        <label>Новая картинка (оставьте пустым, если не менять)</label>
        <input type="file" name="image" accept="image/*" style="width:100%; padding:10px;">
    </div>
    
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection