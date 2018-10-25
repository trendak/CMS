<?php

if (isset($_POST['login'])) {

	$register = true;

	//login validation
	$login = $_POST['login'];
	if ((strlen($login) < 3) || (strlen($login) > 20)) {
		$register = false;
		$_SESSION['e_login'] = 'Login should have between 3 and 20 characters';
	}
	if (ctype_alnum($login) == false) {
		$register = false;
		$_SESSION['e_login'] = 'Login should contain only numbers and letters';
	}
	$result = $pdo->prepare('SELECT id FROM users WHERE login = :login');
	$result->bindParam(':login', $login);
	$result->execute();
	$datalogin = $result->fetch();
	if ($datalogin) {
		$register = false;
		$_SESSION['e_login'] = 'The given login already exists';
	}
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

	if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)) {
		$register = false;
		$_SESSION['e_email'] = "Provide a valid email address";
	}
	$result = $pdo->prepare('SELECT id FROM users WHERE email = :email');
	$result->bindParam(':email', $email);
	$result->execute();
	$dataemail = $result->fetch();
	if ($dataemail) {
		$register = false;
		$_SESSION['e_email'] = 'The given email already exists';
	}
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];
	if ((strlen($password) < 6) || (strlen($password) > 20)) {
		$register = false;
		$_SESSION['e_password'] = 'Password should have between 6 and 20 characters';
	} elseif ($password != $rpassword) {
		$register = false;
		$_SESSION['e_password'] = 'The provided passwords are not identical';
	} else {
		$passwordhash = hash('sha256', $password);
	}
	$secretkey = "6LccdGgUAAAAAK-VlmxarPyqD0Bx0tG9kxAOcDE-";

	$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretkey . '&response=' . $_POST['g-recaptcha-response']);

	$answer = json_decode($check);

	if ($answer->success == false) {
		$register = false;
		$_SESSION['e_bot'] = "Check it if you are not bot";
	}
	if ($register) {
		$defaultimg = 'default.png';
		$result = $pdo->prepare('INSERT INTO users (login, email, password, last_login_date, last_ip, photo) VALUES(:login, :email, :password, :last_login_date, :last_ip, :photo)');
		$result->bindParam(':login', $login);
		$result->bindParam(':email', $email);
		$result->bindParam(':password', $passwordhash);
		$data = date('Y-m-d');
		$result->bindParam(':last_login_date', $data);
		$result->bindParam(':last_ip', $_SERVER['REMOTE_ADDR']);
		$result->bindParam(':photo', $defaultimg);
		$result->execute();
		$_SESSION['loged'] = true;
		$_SESSION['login'] = $login;
		header('location: index.php?v=home');
	}
}

?>








<div class="modal fade show" id="register" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true" style ="display: block;">
    <div class=" modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
              <a href="index.php?">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </a>
            </div>
            <form method="POST">
                <div class="modal-body text-right">


                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" name="login" class="">
                    </div>
                  <?php
if (isset($_SESSION['e_login'])) {
	echo $_SESSION['e_login'];
	unset($_SESSION['e_login']);
}
?>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" name="email" class="">
                    </div>
                    <?php
if (isset($_SESSION['e_email'])) {
	echo $_SESSION['e_email'];
	unset($_SESSION['e_email']);
}
?>
                    <div class="form-group">
                        <label for="Nazwa kategorii">Password</label>
                        <input type="password" name="password" class="">
                    </div>
                    <?php
if (isset($_SESSION['e_password'])) {
	echo $_SESSION['e_password'];
	unset($_SESSION['e_password']);
}
?>
                    <div class="form-group">
                        <label for="Nazwa kategorii">Repeat password</label>
                        <input type="password" name="rpassword" class="">
                    </div>
                  <div class="form-group" style="width: 304px; margin-left: auto;">
                  <div class="g-recaptcha text-right" data-sitekey="6LccdGgUAAAAADAZ_4ZoEpwJ65MWXrSTg4JVJ4_r"></div>
                  </div>
                    <?php
if (isset($_SESSION['e_bot'])) {
	echo $_SESSION['e_bot'];
	unset($_SESSION['e_bot']);
}
?>
                </div>
                <div class="modal-footer">
                    <!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Remind passsword</button>-->
                    <button  class="btn btn-primary">Regiter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>