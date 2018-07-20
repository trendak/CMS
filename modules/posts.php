


<?php
$result = $pdo->query('SELECT categories.*, posts.* FROM `posts` LEFT JOIN categories ON posts.category_id = categories.id');
$posts = $result->fetchAll();

?>
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Posts</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter Posts...">
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                      	<th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Published</th>
                        <th>Created</th>
                        <th></th>
                      </tr>
                      <?php
foreach ($posts as $post) {
	?>
                      <tr>
                      	<td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['name']; ?></td>
                         <td><span class=" glyphicon <?php echo ($post['published'] === true ? 'glyphicon - ok' : 'glyphicon-remove'); ?>" aria-hidden="true"></span></td>
                        <td><?php echo $post['created_date']; ?></td>
                        <td><a class="btn btn-default" <a href="index.php?v=edit_post&id=<?php echo $post['id'] ?>">Edit</a> <a class="btn btn-danger" <a href="index.php?v=delete_post&id=<?php echo $post['id'] ?>">Delete</a></td>
                      </tr>
                   <?php }?>

                    </table>
              </div>
              </div>