<?php
	$result = $pdo->query('SELECT `id`, `name` FROM `categories`');
	$categories = $result->fetchAll();

 ?>

<div class="panel panel-default">
  <div class="panel-heading main-color-bg">
    <h3 class="panel-title">Categories</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <a href="index.php?v=add_category" class="btn btn-primary">Dodaj kategorię</a>
      </div>
    </div>
    <br>
<table class="table table-striped table-hover">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Edit</th>

	</tr>
	<?php 
		foreach ($categories as $category) {
		?>
		<tr>
			<td><?php echo $category['id']; ?></td>
			<td><?php echo $category['name']; ?></td>
			<td><a href="index.php?v=edit_category&id=<?php echo $category['id'] ?>" class="btn btn-default">Edit</a>
			<a href="index.php?v=delete_category&id=<?php echo $category['id'] ?>" class="btn btn-danger">Delete</a></td>
		</tr>
		<?php } ?>
</table>
  </div>
</div>