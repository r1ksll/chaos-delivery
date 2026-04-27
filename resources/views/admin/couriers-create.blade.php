@extends('layouts.app')

@section('content')
<h1>Добавить курьера</h1>

<form action="{{ route('admin.couriers.store') }}" method="POST" style="background:white; padding:20px; border-radius:10px;">
    @csrf
    
    <div style="margin-bottom:15px;">
        <label>Имя</label>
        <input type="text" name="name" required style="width:100%; padding:10px;">
    </div>
    
    <div style="margin-bottom:15px;">
        <label>Телефон</label>
        <input type="text" name="phone" required style="width:100%; padding:10px;">
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection