<?php

$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/config/route-group/',
        APP_PATH . '/validation/'
    ]
);

$loader->registerNamespaces(
	[
        'App\Validation' => APP_PATH . '/Validation/',
		'App\Events' => APP_PATH . '/Events/',
	]
);

$loader->register();