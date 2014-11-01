<!DOCTYPE html>
<html>
<head>
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<meta charset="utf-8">
	<!--[if IEMobile]><meta content="on" http-equiv="cleartype"><![endif]-->
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<link rel="stylesheet" href="/css/application.css">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">

	@yield('head', '')
</head>

<body>
	<div id="main-nav full-width">
		<div class="page-width">
			@yield('nav', '')
		</div>
	</div>
	<div id="content" class="page-width">
		@yield('content', '')
	</div>
</body>
</html>
