<!DOCTYPE html>
<html>
<head>
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<meta charset="utf-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<!--[if IEMobile]><meta content="on" http-equiv="cleartype"><![endif]-->

	<link rel="stylesheet" href="/css/application.css">
	<link rel="stylesheet" href="/css/fontello-ondrovocom.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lora:700,700italic&amp;subset=latin,latin-ext">
	<!--[if IE 7]><link rel="stylesheet" href="/css/fontello-ondrovocom-ie7.css"><![endif]-->

	<script src="/js/jquery.min.js"></script>
	<script src="/js/jquery-migrate.min.js"></script>

	<script>
	</script>

	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">

	@yield('head', '')
</head>

<body>
	<div id="main-nav" class="full-width">
		<div class="page-width">
			@yield('nav', '')
		</div>
	</div>
	<div id="content" class="page-width">
		@yield('content', '')
	</div>
</body>
</html>
