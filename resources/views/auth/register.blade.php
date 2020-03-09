@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    {{Form::model($user, ['url' => route('register.store'), 'method' => 'post'])}}
        {{Form::text('username')}}
        {{Form::label('username', 'Никнейм')}}<br>
        {{Form::password('password')}}
        {{Form::label('password', 'Пароль')}}<br><br>
        {{Form::submit('Зарегистрироваться')}}
    {{Form::close()}}

    @if ($errors->any())
        <br>
        Список ошибок:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection