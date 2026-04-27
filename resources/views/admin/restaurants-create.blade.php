@extends('layouts.app')

@section('content')
<h1>Добавить ресторан</h1>

<form action="{{ route('admin.restaurants.store') }}" method="POST" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    
    <div style="margin-bottom:15px;">
        <label>Название</label>
        <input type="text" name="name" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Город</label>
        <select name="city" required style="width:100%; padding:10px;">
            <option value="Ижевск">Ижевск</option>
            <option value="Казань">Казань</option>
        </select>
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Картинка (путь к файлу)</label>
        <input type="text" name="image" placeholder="/images/restaurants/nazvanie.jpg" style="width:100%; padding:10px;">
        
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection