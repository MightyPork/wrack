<?php

if($image == null)
	$image = '/images/header-default.jpg';

?>

<header style="background-image: url('{{{ $image }}}')">
	<h1>
		{{{ $name }}}
		<div class="links">
			<a href="//twitter.com/MightyPork" target="_blank" class="icon-twitter"></a>{{--
			--}}<a href="//github.com/MightyPork" target="_blank" class="icon-github"></a>{{--
			--}}<a href="//stackoverflow.com/users/2180189/mightypork" target="_blank" class="icon-stackoverflow"></a>
		</div>
	</h1>
</header>
