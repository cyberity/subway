<?php

$f3=require('lib/base.php');

$f3->config('setup.cfg');
$f3->set('sidebar','');

$f3->route('GET /',
	function($f3) {
		$f3->set('sidebar','index');
        echo Template::instance()->render('index.html');
	}
);

$f3->run();
