


<?php
$result = $pdo->query('SELECT * FROM `pages`');
$pages = $result->fetchAll();

?>
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">pages</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter pages...">
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Created</th>

                        <th></th>
                      </tr>
                      <?php
foreach ($pages as $page) {
	?>
                      <tr>
                        <td><?php echo $page['id']; ?></td>
                        <td><?php echo $page['title']; ?></td>
                            <td><span class=" glyphicon <?php echo ($page['published'] == true ? 'glyphicon-ok' : 'glyphicon-remove'); ?>" aria-hidden="true"></span></td>
                        <td><?php echo $page['created_at']; ?></td>
                        <td><a class="btn btn-default" <a href="index.php?v=edit_page&id=<?php echo $page['id'] ?>">Edit</a> <a class="btn btn-danger" <a href="index.php?v=delete_page&id=<?php echo $page['id'] ?>">Delete</a></td>
                      </tr>
                   <?php }?>

                    </table>
              </div>
              </div>