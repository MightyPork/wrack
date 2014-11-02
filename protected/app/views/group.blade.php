<?php namespace MightyPork\Wrack;

$gg = $g->getGroup();

?>

@extends('_layout')


@section('head')
	<title>{{{ App::cfg('title_prefix') . $g->name . App::cfg('title_suffix') }}}</title>

	<meta name="description" content="{{{ $g->description }}}">
	<base href="{{{ $g->path }}}">
@stop


@section('nav')
	<div class="right">
		<a href="/" class="nav-item">Ondrovo.com</a>
	</div>

	<div class="left">
		@if($gg != null)
			<i class="icon-folder"></i><a href="{{{ $gg->path }}}">{{{ $gg->name }}}</a>
		@endif
	</div>
@stop


@section('content')
	<header>
		<h1>{{{ $g->name }}}</h1>
	</header>
	<article>
		<ul id="group-list">
			@foreach($g->group_paths as $path)
				<li>@include('list._group', ['path' => $path])
			@endforeach

			@foreach($g->article_paths as $path)
				<li>@include('list._article', ['path' => $path])
			@endforeach
		</ul>
	</article>
@stop
