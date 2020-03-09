@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    {{Form::model($user, ['url' => route('login.login'), 'method' => 'post'])}}
        {{Form::text('username')}}
        {{Form::label('username', 'Никнейм')}}<br>
        {{Form::password('password')}}
        {{Form::label('password', 'Пароль')}}<br>
        {{Form::checkbox('remember', 'yes')}}
        {{Form::label('remember', 'Запомнить меня')}}<br><br>
        {{Form::submit('Войти')}}
    {{Form::close()}}

    @if ($errors->any() || isset($failed))
        <br>
        Список ошибок:
        <ul>
            @if (isset($failed))
                <li> {{ $failed }}</li>
            @endif
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection