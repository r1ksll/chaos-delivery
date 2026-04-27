@extends('layouts.app')

@section('content')
<div style="max-width:400px; margin:0 auto; background:white; padding:30px; border-radius:10px;">
    <h1>Вход</h1>
    
    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div style="margin-bottom:15px;">
            <label>Телефон</label>
            <input type="text" name="phone" required style="width:100%; padding:10px;">
        </div>
        
        <div style="margin-bottom:15px;">
            <label>Пароль</label>
            <input type="password" name="password" required style="width:100%; padding:10px;">
        </div>
        
        <button type="submit" class="btn btn-primary" style="width:100%;">Войти</button>
    </form>
    
    <p style="margin-top:20px; text-align:center;">
        Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a>
    </p>
</div>
@endsection