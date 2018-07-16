<h1>Logowanie</h1>
<?php 
	session_start();
	unset($_SESSION['error']);
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
	$login = $result->fetch();
	if ($login) {
		$_SESSION['loged'] = true;
		$_SESSION['login'] = $login['login'];
		
		unset($_SESSION['error']);
		$result->closeCursor();
	}
	else{
		$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
		

	}


}
if (isset($_GET['logout'])==1) 
{
	$_SESSION['logout'] = false;
	session_destroy();
}


 ?>



<form method="POST">
	<?php
	if(isset($_SESSION['error']))	echo $_SESSION['error'];
?>
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
