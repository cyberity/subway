<?php

//! basic controller
class Controller {
	//! HTTP route pre-processor
	function beforeroute() {
		$f3=$this->f3;
		$salt=$f3->get('SESSION.password');
		if ($f3->get('SESSION.user_id')!=$f3->get('user_id') ||
			crypt($f3->get('password'),$salt)!=$salt)
			// Invalid session
			$f3->reroute('/login');
		if ($f3->get('SESSION.lastseen')+$f3->get('expiry')*3600<time())
			// Session has expired
			$f3->reroute('/logout');
		// Update session data
		$f3->set('SESSION.lastseen',time());
	}
	function afterroute() {
		// Render HTML layout
		echo Template::instance()->render($this->html.'.html');
	}
	function __construct() {
		$f3=Base::instance();
		// Connect to the database
		$db=new DB\SQL(
			'mysql:host='.$f3->get('DB_HOST').';port='.$f3->get('DB_PORT').';dbname='.$f3->get('DB_NAME').'',
			$f3->get('DB_USER'),
			$f3->get('DB_PASSWORD')
		);
		// Use database-managed sessions
		new DB\SQL\Session($db);
		// Save frequently used variables
		$this->f3=$f3;
		$this->db=$db;
	}
}
