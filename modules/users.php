


<?php
$result = $pdo->query('SELECT * FROM `users`');
$users = $result->fetchAll();

?>
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Users</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter users...">
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                      	<th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last login</th>
                        <th>Last IP</th>
                        <th>Admin</th>
                        <th></th>
                      </tr>
                      <?php
foreach ($users as $user) {
	?>
                      <tr>
                      	<td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['login']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['last_login_date']; ?></td>
                        <td><?php echo $user['last_ip']; ?></td>
                        <td><span class=" glyphicon <?php echo ($user['admin'] == true ? 'glyphicon-ok' : 'glyphicon-remove'); ?>" aria-hidden="true"></span></td>
                        <td><a class="btn btn-default" <a href="index.php?v=edit_user&id=<?php echo $user['id'] ?>">Edit</a> <a class="btn btn-danger" <a href="index.php?v=delete_user&id=<?php echo $user['id'] ?>">Delete</a></td>
                      </tr>
                   <?php }?>

                    </table>
              </div>
              </div>