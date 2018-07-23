<?php

function dump($var)
{
	echo '<pre>';
print_r($var);
echo '</pre>';
}
function dd($var){
	dump($var);
	die;
}

function howManyRecords()
{
    global $pdo;
    $pages = $pdo->prepare('SELECT * FROM pages');
    $pages->execute();
    $_SESSION['pages'] = $pages->rowCount();
    $posts= $pdo->prepare('SELECT * FROM posts');
    $posts->execute();
    $_SESSION['posts'] = $posts->rowCount();
    $users = $pdo->prepare('SELECT * FROM users');
    $users->execute();
    $_SESSION['users'] = $users->rowCount();
}
?>