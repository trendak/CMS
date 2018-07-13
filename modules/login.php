<h1>Logowanie</h1>
<?php 
	session_start();
if (isset($_POST['login']) && isset($_POST['password'])) {
		$login = $_POST['login'];
	$password = $_POST['password'];

	//anty wstrzykiwanie sql
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$password = htmlentities($password, ENT_QUOTES, "UTF-8");
	$result = $pdo->prepare('SELECT * FROM users WHERE login = :login AND password = :password');
	$result->bindParam('login', $login);
	$result->bindParam('password', $password);
	$result->execute();
	$login = $result->fetchAll();
	echo $login['login'];
	if ($result) {
		var_dump($result);
	}


}



 ?>


<form method="POST">
	<div class="">
		<label for="login">Login</label>
		<input type="text" name="login" class="">
	</div>
	<div class="">
		<label for="Nazwa kategorii">Hasło</label>
		<input type="password" name="password" class="">
	</div>
	<div class="">
			<button class="btn btn-primary">Zaloguj</button>
		</div>
</form>