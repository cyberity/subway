<?php
class User extends Controller{
	function beforeroute() {
	}
	function login() {
		$this->html = 'login';
	}

	//! Process login form
	function auth() {
		$f3=$this->f3;
		$salt=crypt($f3->get('POST.password'));
		if (false &&( $f3->get('POST.user_id')!=$f3->get('user_id') ||
			crypt($f3->get('password'),$salt)!=$salt)) {
			$f3->set('message','Invalid user ID or password');
			$this->login();
		}
		else {
			$f3->set('SESSION.user_id',$f3->get('POST.user_id'));
			$f3->set('SESSION.password',
				crypt($f3->get('password'),$salt));
			$f3->set('SESSION.lastseen',time());
			$f3->reroute('/');
		}
	}

	//! Terminate session
	function logout() {
		$f3=$this->f3;
		$f3->clear('SESSION');
		$f3->reroute('/login');
	}
}
?>