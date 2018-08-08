<?php
$result = $pdo->prepare('SELECT *  FROM `pages` WHERE title = :title ');
$result->bindParam(':title', $_GET['title'] );
$result->execute();

$page = $result->fetch();


?>
<div class="col-lg-8 col-md-10 mx-auto">

    <h1><?php echo $page['title'] ?></h1>
    <div><?php echo $page['body'] ?></div>
<!--    <p class="page-meta">page by-->
<!---->
<!--        on --><?php
//        $date = $page['created_at'];
//        $date = date("d.m.Y H:i", strtotime($date));
//        echo $date; ?><!--</p>-->
</div>
