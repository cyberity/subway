<?php
class User extends Controller{
	function beforeroute() {
	}
	function login() {
		$f3=$this->f3;
		/* Uncomment if desired
		$loc=Web\Geo::instance()->location();
		if (isset($loc['continent_code']) && $loc['continent_code']=='EU')
			$f3->set('message',
				'The administrator pages of this Web site uses cookies for '.
				'identification and security. Without these cookies, these '.
				'pages would simply be inaccessible. By using these pages '.
				'you agree to this safety measure.');
		*/
		$f3->set('COOKIE.sent',TRUE);
		$f3->set('inc','login.htm');
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