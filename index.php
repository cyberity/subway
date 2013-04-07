<?php

$f3=require('lib/base.php');

$f3->set('DEBUG',3);
$f3->set('UI','ui/');

$f3->route('GET /',
	function($f3) {
		$classes=array(
			'Base'=>
				array(
					'hash',
					'json',
					'session'
				),
			'Cache'=>
				array(
					'apc',
					'memcache',
					'wincache',
					'xcache'
				),
			'DB\SQL'=>
				array(
					'pdo',
					'pdo_dblib',
					'pdo_mssql',
					'pdo_mysql',
					'pdo_odbc',
					'pdo_pgsql',
					'pdo_sqlite',
					'pdo_sqlsrv'
				),
			'DB\Jig'=>
				array('json'),
			'DB\Mongo'=>
				array(
					'json',
					'mongo'
				),
			'Auth'=>
				array('ldap','pdo'),
			'Image'=>
				array('gd'),
			'Lexicon'=>
				array('iconv'),
			'SMTP'=>
				array('openssl'),
			'Web'=>
				array('curl','openssl','simplexml'),
			'Web\Geo'=>
				array('geoip','json'),
			'Web\OpenID'=>
				array('json','simplexml'),
			'Web\Pingback'=>
				array('dom','xmlrpc')
		);
		$f3->set('classes',$classes);
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
