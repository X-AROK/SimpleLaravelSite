@extends('layouts.app')

@section('title', 'Посты')

@section('content')
	@if (Auth::check())
		<a href="{{ route('posts.create') }}">Создать пост</a><br><br>
	@endif
    {{ Form::open(['method' => 'get']) }}
        {{ Form::search('q', $q, ['placeholder' => 'Поиск']) }}
        {{ Form::submit('Найти') }}
    {{ Form::close() }}
    @if ($posts->count() > 0)
        <p>Список постов:</p>
        <ul>
        	@foreach ($posts as $post)
        		<li><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></li>
        	@endforeach
        </ul>
        {{ $posts->links() }}
    @else
        <p>Постов не найдено.</p>
    @endif
@endsection