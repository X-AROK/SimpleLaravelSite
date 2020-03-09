@extends('layouts.app')

@section('title', 'Создать пост')

@section('content')
    {{Form::model($post, ['url' => route('posts.store'), 'method' => 'post'])}}
        @include('posts.shared.form')
        {{Form::submit('Создать')}}
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