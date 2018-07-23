<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">AdminStrap</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo ($_GET['v'] == 'dashboard' ? 'active' : ''); ?>"><a href="?v=dashboard">Dashboard</a></li>
            <li class="<?php echo ($_GET['v'] == 'pages' ? 'active' : ''); ?>"><a href="?v=pages">Pages</a></li>
            <li class="<?php echo ($_GET['v'] == 'posts' ? 'active' : ''); ?>"><a href="?v=posts">Posts</a></li>
            <li class="<?php echo ($_GET['v'] == 'users' ? 'active' : ''); ?>"><a href="?v=users">Users</a></li>
          </ul>

          <?php
if (isset($_SESSION['loged'])) {
	echo ' <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome ' . $_SESSION['login'] . '</a></li>
            <li><a href="?logout=1">Logout</a></li>
          </ul>';
}
?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Content
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a type="button" data-toggle="modal" data-target="#addPage">Add Page</a></li>
                <li><a type="button" data-toggle="modal" data-target="#addPost">Add Post</a></li>
                <li><a href="#">Add User</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>
    <?php
if (isset($_SESSION['communique'])) {
	echo ' <section id="alertsucces">
      <div class="container">
        <div class="alertsucces">
          ' . $_SESSION['communique'] . '
          </div>

      </div>
    </section>';
	unset($_SESSION['communique']);
}

?>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.html" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="pages.html" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages <span class="badge"><?php echo $_SESSION['pages'] ?></span></a>
              <a href="posts.html" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge"><?php echo $_SESSION['posts'] ?></span></a>
              <a href="users.html" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $_SESSION['users'] ?></span></a>
            </div>

            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">

                   <?php
                      $freesize = disk_free_space("/") / disk_total_space("/");
                      $freesize = round($freesize, 2);
                      echo '<div class="progress-bar" role="progressbar" aria-valuenow="' .  $freesize * 100 . '" aria-valuemin="0" aria-valuemax="100" style="width: ' .  $freesize * 100 . '%;">';
                      echo $freesize * 100 . "%";
                      echo ' </div>';

                   ?>

            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <?php echo $content; ?>

        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright AdminStrap, &copy; 2017</p>
    </footer>

    <!-- Modals -->

    <!-- Add Page -->
<?php
include 'modules/add_page.php';
include 'modules/add_post.php';
?>



  <script>
     CKEDITOR.replace( 'editor1' );
     CKEDITOR.replace( 'body' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
