<?php

class User extends Model {

    public function auth($login, $pass) {
	$isAuth = false;
	$user = new Database();
	$user->query('select * from users where login = :login and pass = :pass');
	$user->bind('login', $login);
	$user->bind('pass', md5($pass));
	$userInfo = $user->find();
	if ($userInfo) {
	    $_SESSION['is_auth'] = true;
	    $_SESSION['uid'] = $userInfo['id'];
	    $isAuth = $userInfo['id'];
	}

	return $isAuth;
    }
    
    public function logout(){
	$_SESSION['is_auth'] = false;
    }

    public function get($uid) {
	$user = new Database();
	$user->query('select * from users where id = :uid');
	$user->bind('uid', $uid);
	return $user->find();
    }

}
