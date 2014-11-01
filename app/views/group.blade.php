<?php namespace MightyPork\Wrack; ?>

@extends('layout')


@section('head')
	<title>{{{ App::cfg('title_prefix') . $g->name . App::cfg('title_suffix') }}}</title>

	<meta name="description" content="{{{ $g->description }}}">
	<base href="/{{{ $g->path }}}">
@stop


@section('nav')
	<div class="left">
		<a href="/" class="nav-item">Ondrovo.com</a>
	</div>

	<div class="right">
		Goto parent group boo boo.
	</div>
@stop


@section('content')
	<header>
		<h1>{{{ $g->name }}}</h1>
	</header>
	<ul id="group-list">

		@foreach($g->groups as $path)
			<li>@include('_group', ['path' => $path])
		@endforeach

		@foreach($g->articles as $path)
			<li>@include('_article', ['path' => $path])
		@endforeach

	</ul>
@stop
