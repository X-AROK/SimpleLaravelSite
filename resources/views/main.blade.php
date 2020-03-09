@extends('layouts.app')

@section('title', 'Главная')

@section('content')
	<p>
		@if (Auth::check())
	        Привет, {{ Auth::user()->username }}!
	        <br>Ваших постов: {{ Auth::user()->posts->count() }}
	        <br>Ваших лайков: {{ Auth::user()->likes->count() }}
		@else
			Вы не авторизовались.
			<br>Чтобы использовать все функции сайта, пожалуйста, войдите или зарегистрируйтесь.
	    @endif
	</p>
@endsection
