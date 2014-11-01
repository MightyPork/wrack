<?php namespace MightyPork\Wrack; ?>

@extends('layout')


@section('head')
	<title>{{{ App::cfg('title_prefix') . $a->name . App::cfg('title_suffix') }}}</title>

	<meta name="description" content="{{{ $a->description }}}">
	<meta name="author" content="{{{ $a->author }}}">
	<base href="/{{{ $a->path }}}/">
@stop


@section('nav')
	<div class="left">
		<a href="/" class="nav-item">Ondrovo.com</a>
	</div>

	<div class="right">
		Group fubar - goto there.
	</div>
@stop


@section('content')
	<header>
		<h1>{{{ $a->name }}}</h1>
	</header>
	<article>
		{{ $a->render() }}
	</article>
	<footer>
		@include('article_footer')
	</footer>
@stop
