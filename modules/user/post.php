<?php
$result = $pdo->prepare('SELECT users.*, categories.name AS categoryname, posts.*  FROM `posts` LEFT JOIN categories ON posts.category_id = categories.id LEFT JOIN users ON posts.user_id = users.id WHERE posts.id = :id ');
$result->bindValue(':id', $_GET['id']);
$result->execute();

$post = $result->fetch();
$result = $pdo->prepare('SELECT users.*, comments.* FROM comments LEFT JOIN  users ON comments.user_id = users.id WHERE comments.post_id = :post_id ORDER BY comments.id DESC');
$result->bindValue(':post_id', $post['id']);
$result->execute();
$data = date('Y-m-d');
$comments = $result->fetchall();
if (isset($_POST['text'])) {
	$result = $pdo->prepare('SELECT id FROM users WHERE login = :login');
	$result->bindParam(':login', $_SESSION['login']);
	$result->execute();
	$user = $result->fetch();
	$data = date('Y-m-d');

	$result = $pdo->prepare('INSERT INTO comments (text, post_id, user_id, created_at) VALUES(:text, :post_id, :user_id, :created_at)');
	$result->bindParam(':text', $_POST['text']);
	$result->bindParam(':post_id', $post['id']);
	$result->bindParam(':user_id', $user['id']);
	$result->bindParam(':created_at', $data);
	$result->execute();
	header('refresh: 1;');

}

?>
<div class="col-lg-8 col-md-10 mx-auto">

    <h1><?php echo $post['title'] ?></h1>
    <div><?php echo $post['body'] ?></div>
    <p class="post-meta">Posted by
        <a href="#"><?php echo $post['login'] ?></a>
        on <?php
$date = $post['created_date'];
$date = date("d.m.Y H:i", strtotime($date));
echo $date;?></p>

<hr>
<!--<p>Comments</p>-->

<!--</div>-->
    <div class="row bootstrap snippets">
        <div class="col-md-12 col-md-offset-2 col-sm-12">
            <div class="comment-wrapper">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Comments
                    </div>
                    <div class="panel-body">
                        <?php
if (isset($_SESSION['login'])) {
	?>
                            <form method="POST">
                                <textarea class="form-control" name ="text" placeholder="write a comment..." rows="3"></textarea>
                                <br>
                                <button type="submit" class="btn btn-info pull-right">Post</button>
                            </form>
                            <?php
} else {
	echo 'only for logged users';
}
?>
                        <div class="clearfix"></div>
                        <hr>
                        <ul class="media-list">
                            <?php
if ($comments) {
	foreach ($comments as $comment) {
		?>
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="uploads/<?php echo $comment['photo'] ?>" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-muted"><?php echo $comment['created_at']; ?></small>
                                </span>
                                    <strong class="text-success">@<?php echo $comment['login']; ?></strong>
                                    <p>
                                        <?php echo $comment['text']; ?>
                                    </p>
                                </div>
                            </li>
                            <?php
}
} else {
	echo 'no comments, write first';
}

?>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>