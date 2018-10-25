<?php

if (isset($_SESSION['error'])) {
	unset($_SESSION['error']);
}

if (isset($_POST['login']) && isset($_POST['password'])) {
	$login = $_POST['login'];
	$password = $_POST['password'];

	//anty wstrzykiwanie sql
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");

	$password = htmlentities($password, ENT_QUOTES, "UTF-8");
	$password = hash('sha256', $password);
	$result = $pdo->prepare('SELECT * FROM users WHERE login = :login AND password = :password');
	$result->bindParam('login', $login);
	$result->bindParam('password', $password);
	$result->execute();
	$login = $result->fetch();
	if ($login) {
		$_SESSION['loged'] = true;
		$_SESSION['login'] = $login['login'];
		if ($login['admin']) {
			$_SESSION['admin'] = true;
		}
		unset($_SESSION['error']);
		$result->closeCursor();
		$result = $pdo->prepare('UPDATE users SET last_login_date= :last_login_date, last_ip = :last_ip WHERE id = :id');
		$data = date('Y-m-d');
		$result->bindParam(':last_login_date', $data);
		$result->bindParam(':last_ip', $_SERVER['REMOTE_ADDR']);
		$result->bindParam(':id', $login['id']);
		$result->execute();
		//licznik stron aktualizowany przy lgoowaniu
		howManyRecords();

	} else {
		$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';

	}

}
if (isset($_GET['logout']) == 1) {
	$_SESSION['logout'] = false;
	session_destroy();
}

?>
