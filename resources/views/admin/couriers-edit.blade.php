@extends('layouts.app')

@section('content')
<h1>Редактировать курьера</h1>

<form action="{{ route('admin.couriers.update', $courier->id) }}" method="POST" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom:15px;">
        <label>Имя</label>
        <input type="text" name="name" value="{{ $courier->name }}" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Телефон</label>
        <input type="text" name="phone" value="{{ $courier->phone }}" required style="width:100%; padding:10px;">
    </div>
    
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection