<?php

$f3=require('lib/base.php');

$f3->config('setup.cfg');

$f3->route('GET /',
	function($f3) {
		$f3->set('sidebar','index');
		$template=new Template;
        echo $template->render('index.html');
	}
);

$f3->route('GET /userref',
	function() {
		echo View::instance()->render('userref.htm');
	}
);

$f3->route('GET /signin',
	function($f3) {
		$f3->set('sidebar','');
        $template=new Template;
        echo $template->render('signin.html');
	}
);

$f3->run();
