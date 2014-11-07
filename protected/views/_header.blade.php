<?php

/** This view is used for the header box with image background and heading. */

if($image == null)
	$image = '/images/header-default.jpg';

?>

<header style="background-image: url('{{{ $image }}}')">
	<h1>
		<div id="soclink-bubble"></div>
		<i class="icon-{{{ $type }}}"></i>
		{{{ $name }}}
		<div class="links">
			<a href="//twitter.com/MightyPork"
			   target="_blank"
			   class="soclink icon-twitter"
			   data-title="Follow @MightyPork"></a>{{--

		--}}<a href="//github.com/MightyPork?tab=repositories"
			   target="_blank"
			   class="soclink icon-github hide-lowres"
			   data-title="MightyPork's GitHub"></a>{{--

		--}}<a href="//stackoverflow.com/users/2180189/mightypork"
			   target="_blank"
			   class="soclink icon-stackoverflow hide-lowres"
			   data-title="MightyPork's StackOverflow"></a>
		</div>
	</h1>
</header>
