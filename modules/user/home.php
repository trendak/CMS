<?php

$result = $pdo->query('SELECT users.*, categories.name AS categoryname, posts.* FROM `posts` LEFT JOIN categories ON posts.category_id = categories.id LEFT JOIN users ON posts.user_id = users.id');
$posts = $result->fetchAll();
?>
<div class="col-lg-8 col-md-10 mx-auto">

    <?php

    foreach($posts as $post)
    {
        ?>
        <div class="post-preview">
            <a href="?v=post&id=<?php echo $post['id'] ?>">
                <h2 class="post-title">
                    <?php echo $post['title'] ?>
                </h2>

            </a>
            <p><?php echo $post['body'] ?></p>
            <p class="post-meta">Posted by
                <a href="#"><?php echo $post['login'] ?></a>
                on <?php
                $date = $post['created_date'];
                $date = date("d.m.Y H:i", strtotime($date));
                echo $date; ?></p>
        </div>
        <hr>
        <?php
    }
    ?>

    <!-- Pager -->
    <div class="clearfix">
        <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
    </div>
</div>
</div>
