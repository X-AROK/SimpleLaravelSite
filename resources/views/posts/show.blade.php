@extends('layouts.app')

@section('title', "Пост №{$post->id}")

@section('content')
	<h4>{{ $post->title }}</h4>
    <p>{{ $post->body }}</p>
    <p>Лайков: {{ $post->likes->count() }} 
        @if (Auth::check())
        | <a href="{{ route('like', $post) }}">
            @if (Auth::user()->getPostLikeId($post))
                Убрать
            @else
                Поставить
            @endif
        </a>
        @endif
        <br>Автор: {{ $post->creator->username }}
        <br>Создан {{ $post->created_at }} | Обновлен {{ $post->updated_at }}</p>
    @if (Gate::allows('update-post', $post))
        <a href="{{ route('posts.edit', $post) }}">Изменить</a> | 
        <a href="{{ route('posts.destroy', $post) }}" data-confirm="Вы уверены, что хотите удалить этот пост?" data-method="delete" rel="nofollow">Удалить</a>
    @endif
@endsection