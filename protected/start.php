<?php

define('VIEWS_DIR', __DIR__ . '/views/');
define('CACHE_DIR', __DIR__ . '/../tmp/');
define('DATA_DIR', __DIR__ . '/articles/');


// server timezone
date_default_timezone_set('Europe/Prague');


// use the Whoops crash handler
$whoops = new \Whoops\Run;

//*
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
/*/
$whoops->pushHandler(function($e){
	echo $e->getMessage();
	exit;
});
//*/

$whoops->register();

use MightyPork\Wrack\App;

try {

	(new App)->start();

} catch(MightyPork\Wrack\HtmlException $e) {
	http_response_code($e->getCode());

	// TODO: show error message page.
	echo $e->getMessage();
}

exit;
