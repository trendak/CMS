<?php

$result = $pdo->query('SELECT * FROM pages');
$pages = $result->fetchAll();
if (!isset($_SESSION['login']))
include_once('modules/user/login.php');
if (isset($_GET['logout']) == 1) {


    @session_destroy();
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header('location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8 ">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Clean Blog - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="index.php?">Blog</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

          <?php
          foreach ($pages as $page) {
              ?>

            <li class="nav-item">
              <a class="nav-link" href="?v=page&title=<?php echo $page['title']  ?>"><?php echo $page['title']; ?></a>
            </li>
              <?php
          }
          if (isset($_SESSION['login']))
          {
            echo '<li class="nav-item"> <a href="" class="nav-link">' . $_SESSION['login'] . '</a></li>';
              echo '<li class="nav-item"> <a href="?logout=1"" class="nav-link">Wyloguj się</a></li>';
          }
          else{
            echo '<li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#login">Login</a></li>';
              echo '<li class="nav-item"> <a href="?v=register"" class="nav-link">Zarejestruj się</a></li>';
          }
        ?>


      </ul>
    </div>
  </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Clean Blog</h1>
          <span class="subheading">A Blog Theme by Start Bootstrap</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
      <?php echo $content; ?>
</div>

<hr>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <ul class="list-inline text-center">
          <li class="list-inline-item">
            <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
            </a>
          </li>
        </ul>
        <p class="copyright text-muted">Copyright &copy; Your Website 2018</p>
      </div>
    </div>
  </div>
</footer>

<?php

if(!(isset($_SESSION['login'])) && @(!($_GET['v'] == 'register'))) {
    ?>
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
       aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST">
          <div class="modal-body text-center">

              <?php
              if (isset($_SESSION['error'])) {
                  echo $_SESSION['error'];
              }


              ?>
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" name="login" class="">
            </div>

            <div class="form-group">
              <label for="Nazwa kategorii">Hasło</label>
              <input type="password" name="password" class="">
            </div>


          </div>
          <div class="modal-footer">
            <!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Remind passsword</button>-->
            <button  class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    <?php
}
?>
<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>

</body>

</html>
