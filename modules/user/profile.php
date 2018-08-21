<?php
if (isset($_SESSION['login'])) {
      $result = $pdo->prepare('SELECT * FROM users WHERE login = :login');
    $result->bindParam(':login', $_SESSION['login']);
    $result->execute();
    $user = $result->fetch();

    if (isset($_POST['submit'])) {
        $edit = true;

      if ($_FILES['file']['error'] != 4)
      {
        $file = $_FILES['file'];

        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];
        $file_temporary_name = $_FILES['file']['tmp_name'];

        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allowed = array('jpg', 'jpeg', 'png');


        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 500000) {
                    $file_nameNew = uniqid('', true) . "." . $file_actual_ext;
                    $file_destination = 'uploads/' . $file_nameNew;
                    move_uploaded_file($file_temporary_name, $file_destination);

                } else {
                    $edit = false;
                    $_SESSION['e_file'] = 'Your file is too big';
                }
            } else {
                $edit = false;
                $_SESSION['e_file'] ='There was an error uploading yur file';
            }
        } else {
            $edit = false;
            $_SESSION['e_file'] = 'You cannot upload files of this type';
        }
    }

    if (isset($_POST['email']) && !empty($_POST['email']))
    {


            $email = $_POST['email'];
            $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

            if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
            {
                $edit = false;
                $_SESSION['e_email']="Provide a valid email address";
            }
            $result = $pdo->prepare('SELECT id FROM users WHERE email = :email');
            $result->bindParam(':email', $email);
            $result->execute();
            $dataemail = $result->fetch();
            if ($dataemail)
            {
                $edit = false;
                $_SESSION['e_email'] = 'The given email already exists';
            }

    }
    if (isset($_POST['password']) && !empty($_POST['password']))
    {
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        if ((strlen($password) < 6) || (strlen($password) > 20)) {
            $edit = false;
            $_SESSION['e_password'] = 'Password should have between 6 and 20 characters';
        }
        elseif ($password !=$rpassword )
        {
            $edit = false;
            $_SESSION['e_password'] = 'The provided passwords are not identical';
        }
        else{
            $passwordhash = hash('sha256', $password);
        }
    }

        if ($edit){
          $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email']: $user['email'];
          $password = isset($_POST['password']) && !empty($_POST['password']) ? $passwordhash : $user['password'];
          $file = ($_FILES['file']['error'] != 4)?$file_nameNew:$user['photo'];

            $result = $pdo->prepare('UPDATE users SET email = :email, password = :password, photo = :photo WHERE id = :id');
            $result->bindParam(':email',$email );
            $result->bindParam(':password', $password);
            $result->bindParam(':photo', $file);
            $result->bindParam(':id', $user['id']);
            $result->execute();
        }
    }


}
else{
    header('location: index.php?v=home');
}
?>


<form method="POST"   class="centerform col-md-8" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <small id="fileHelp" class="form-text text-muted text-danger"><?php
        if (isset($_SESSION['e_email']))
        {
            echo $_SESSION['e_email'];
            unset($_SESSION['e_email']);
        }
        ?></small>
    <input type="text" class="form-control"  name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $user['email'] ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <small id="fileHelp" class="form-text text-muted text-danger"><?php
        if (isset($_SESSION['e_password']))
        {
            echo $_SESSION['e_password'];
            unset($_SESSION['e_password']);
        }
        ?></small>
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control"  name="password" id="exampleInputPassword1" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;;">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Repeat password</label>
    <input type="password" class="form-control" name="rpassword" id="exampleInputPassword2" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
  </div>


  <div class="form-group">
    <small id="fileHelp" class="form-text text-muted text-danger"><?php
        if (isset($_SESSION['e_file']))
        {
            echo $_SESSION['e_file'];
            unset($_SESSION['e_file']);
        }
        ?></small>
    <label for="exampleInputFile">Photo</label>
    <input type="file" class="form-control-file" id="exampleInputFile" name="file" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">Choose a photo for your avatar</small>
  </div>


  <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
</form>
