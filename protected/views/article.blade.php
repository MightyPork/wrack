<?php namespace MightyPork\Wrack;

/** The article body view */

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
	<a href="{{{ $ag->path }}}" class="path nav-item">
		<i class="icon-back"></i>{{{ $ag->name }}}
	</a>

	<a href="/" class="home nav-item">
		<span class="text">{{{ App::cfg('home_button_text') }}}</span><i class="icon-globe"></i>
	</a>
@stop


@section('content')
	@include('_header', ['type' => 'article', 'image' => $a->getHeader(), 'name' => $a->name])
	<article>
		{{ $body }}
	</article>
	<footer>
		Article by {{{ $a->author }}}, published {{{ date('j. n. Y', $a->created) }}}.
	</footer>
@stop
