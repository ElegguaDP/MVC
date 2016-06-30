<?php

class UserController extends Controller {

    //login page
    public function actionIndex() {
	$errorLogin = '';
	$errorPass = '';
	$mainError = '';
	if (!isset($_SESSION['is_auth']) || !$_SESSION['is_auth']) {
	    if (isset($_POST['login']) && !$_POST['login']) {
		$errorLogin = 'Please, enter your login';
	    }
	    if (isset($_POST['pass']) && !$_POST['pass']) {
		$errorPass = 'Please, enter your pass';
	    }

	    if (isset($_POST['login']) && strip_tags($_POST['login']) != '' && isset($_POST['pass']) && strip_tags($_POST['pass']) != '') {
		$userModel = new User();
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		$userUid = $userModel->auth($login, $pass);
		if ($userUid) {
		    $user = $userModel->get($userUid);
		    $this->view->render('index.php', [
			'userText' => $user['text']
		    ]);
		} else {
		    $mainError = 'Incorrect password and/or login.';
		}
	    }

	    $this->view->render('login.php', [
		'errorLogin' => $errorLogin,
		'errorPass' => $errorPass,
		'mainError' => $mainError
	    ]);
	} else {
	    $userModel = new User();
	    $user = $userModel->get($_SESSION['uid']);
	    $this->view->render('index.php', [
		'userText' => $user['text']
	    ]);
	}
    }

    //admin user's list page
    public function actionList() {
	$error = '';
	$users = [];
	if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1) {
	    $model = new Database();
	    $model->query('select * from users');
	    $model->execute();
	    $users = $model->findAll();
	} else {
	    $error = 'Access denied!';
	}
	$this->view->render('admin.php', [
	    'users' => $users,
	    'error' => $error
	]);
    }

    //logout function
    public function actionLogout() {
	$userModel = new User();
	$userModel->logout();
	header('Location:/adminpanel/');
    }

    //admin's create new user
    public function actionCreate() {
	$error = '';
	if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1) {
	    if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['text'])) {
		$login = trim(strip_tags($_POST['login']));
		$pass = trim(strip_tags($_POST['pass']));
		$email = trim(strip_tags($_POST['email']));
		$text = trim(strip_tags($_POST['text']));

		if ($login && $pass && $text) {
		    $model = new Database();
		    $model->query('insert into users (login,pass,email,text) values (:login, :pass, :email, :text)');
		    $params = [
			'login' => $login,
			'pass' => md5($pass),
			'email' => $email,
			'text' => $text
		    ];
		    if ($model->execute($params)) {
			header('Location:/adminpanel/User/List');
		    } else {
			throw new Exception('Server Error', 500);
		    }
		}
	    }
	} else {
	    $error = 'Access denied!';
	}
	$this->view->render('_form_create.php', [
	    'error' => $error
	]);
    }

    //admin's update user by user ID
    public function actionUpdate($uid) {
	if ($uid && is_numeric($uid)) {
	    $error = '';
	    $user = '';
	    if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1) {
		$userModel = new User();
		$user = $userModel->get($uid);
		if ($user) {
		    if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['text'])) {
			$login = trim(strip_tags($_POST['login']));
			$pass = trim(strip_tags($_POST['pass']));
			$email = trim(strip_tags($_POST['email']));
			$text = trim(strip_tags($_POST['text']));

			if ($uid && $login && $pass && $text) {
			    $model = new Database();
			    $model->query('update users set login = :login, pass = :pass, email = :email, text = :text where id = :uid');
			    $params = [
				'login' => $login,
				'pass' => md5($pass),
				'email' => $email,
				'text' => $text,
				'uid' => $uid
			    ];
			    if ($model->execute($params)) {
				header('Location:/adminpanel/User/List');
			    } else {
				throw new Exception('Server Error', 500);
			    }
			}
		    }
		} else {
		    $error = 'User not found!';
		}
	    } else {
		$error = 'Access denied!';
	    }
	    $this->view->render('_form_update.php', [
		'user' => $user,
		'error' => $error
	    ]);
	} else {
	    throw new Exception('Page not found!', 404);
	}
    }

    //admin's delete user by user ID
    public function actionDelete($uid) {
	if ($uid && is_numeric($uid)) {
	    $user = new Database();
	    $user->query('delete from users where id = :uid');
	    if ($user->execute(['uid' => $uid])) {
		header('Location:/adminpanel/User/List');
	    } else {
		throw new Exception('Server Error', 500);
	    }
	} else {
	    throw new Exception('Page not found!', 404);
	}
    }

}
