@extends('layouts.app')

@section('title', 'Обновить пост')

@section('content')
    {{Form::model($post, ['url' => route('posts.update', $post), 'method' => 'patch'])}}
        @include('posts.shared.form')
        {{Form::submit('Обновить')}}
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