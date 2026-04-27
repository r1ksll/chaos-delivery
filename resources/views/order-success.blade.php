@extends('layouts.app')

@section('content')
<div style="text-align:center; padding:50px; background:white; border-radius:10px;">
    <h1 style="color:#e94560;">Спасибо за заказ!</h1>
    <p>Ваш заказ принят. Скоро с вами свяжется курьер.</p>
    <a href="/" class="btn btn-primary" style="display:inline-block; margin-top:20px;">На главную</a>
</div>

<script>
    alert('Спасибо за заказ!');
</script>
@endsection