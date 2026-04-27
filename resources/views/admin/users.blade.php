@extends('layouts.app')

@section('content')
<h1>Пользователи</h1>

<table style="width:100%; background:white; border-radius:10px; overflow:hidden;">
    <thead>
        <tr style="background:#1a1a2e; color:white;">
            <th style="padding:10px;">ID</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->email ?? '-' }}</td>
            <td>{{ $user->role }}</td>
            <td>
                @if($user->role !== 'admin')
                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:#e94560; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">Удалить</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection