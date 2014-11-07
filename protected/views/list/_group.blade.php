<?php namespace MightyPork\Wrack;

/** Element of the group listing, for group. */

$gg = new Group($path);

$icon = $gg->getIcon();
if($icon == null)
	$icon = '/images/icon-group-default.jpg';

?>

<a class="group-list-item group" href="{{{ $gg->path }}}">
	<span class="inner">
		<span class="icon" style="background-image: url({{{ $icon }}});"></span>
		<span class="name"><i class="icon-group"></i>{{{ $gg->name }}}</span>
		<span class="description">{{{ $gg->description }}}</span>
	</span>
</a>
