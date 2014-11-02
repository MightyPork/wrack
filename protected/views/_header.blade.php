<?php

if($image == null)
	$image = '/images/header-default.jpg';

?>

<header style="background-image: url('{{{ $image }}}')">
	<h1>
		{{{ $name }}}
		<div class="links">
			<a href="//github.com/MightyPork" class="icon-github"></a>{{--
			--}}<a href="//twitter.com/MightyPork" class="icon-twitter"></a>{{--
			--}}<a href="//plus.google.com/+OndrejHruska" class="icon-googleplus"></a>{{--
			--}}<a href="//stackoverflow.com/users/2180189/mightypork" class="icon-stackoverflow"></a>
		</div>
	</h1>
</header>
