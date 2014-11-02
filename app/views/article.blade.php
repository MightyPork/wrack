<?php namespace MightyPork\Wrack;

$ag = $a->getGroup();

$arendered = $a->render();
$head = $arendered->head;
$body = $arendered->body;

?>

@extends('_layout')


@section('head')
	<title>{{{ App::cfg('title_prefix') . $a->name . App::cfg('title_suffix') }}}</title>

	<meta name="description" content="{{{ $a->description }}}">
	<meta name="author" content="{{{ $a->author }}}">
	<base href="{{{ $a->path }}}">
	{{ $head }}
@stop


@section('nav')
	<div class="right">
		<a href="/" class="nav-item">Ondrovo.com</a>
	</div>

	<div class="left">
		<i class="icon-folder"></i><a href="{{{ $ag->path }}}">{{{ $ag->name }}}</a>
	</div>
@stop


@section('content')
	<header>
		<h1>{{{ $a->name }}}</h1>
	</header>
	<article>
		{{ $body }}
	</article>
	<footer>
		Article by {{{ $a->author }}}, published {{{ date('Y-m-d', $a->created) }}}
	</footer>
@stop
