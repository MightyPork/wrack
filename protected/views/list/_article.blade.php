<?php namespace MightyPork\Wrack;

/** Element of the group listing, for article. */

$aa = new Article($path);

$icon = $aa->getIcon();
if($icon == null)
	$icon = '/images/icon-article-default.jpg';

?>

<a class="group-list-item article" href="{{{ $aa->path }}}">
	<span class="inner">
		<span class="icon" style="background-image: url({{{ $icon }}});"></span>
		<span class="name"><i class="icon-article"></i>{{{ $aa->name }}}</span>
		<span class="description">{{{ $aa->description }}}</span>
	</span>
</a>
