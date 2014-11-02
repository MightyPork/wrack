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
	@if($gg == null)
		<span class="path nav-item root nav-item">
			<i class="icon-home"></i>Root
		</span>
	@else
		<a href="{{{ $gg->path }}}" class="path nav-item">
			<i class="icon-group-active"></i>{{{ $gg->name }}}
		</a>
	@endif

	<a href="/" class="home nav-item">
		<span class="text">Ondrovo.com</span><i class="icon-globe"></i>
	</a>
@stop


@section('content')
	@include('_header', ['type' => 'group', 'image' => $g->getHeader(), 'name' => $g->name])
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
