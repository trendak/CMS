<h1>Edytowanie posta</h1>
<?php 

	if(isset($_POST['title'])){
	$result = $pdo->prepare('UPDATE posts SET title= :title,body = :body, category_id =:category_id WHERE id = :id');
	$result->bindParam(':title', $_POST['title']);
	$result->bindParam(':body', $_POST['body']);
	$result->bindParam(':category_id', $_POST['category_id']);
	$result->bindParam(':id', $_GET['id']);
	$result->execute();

	header('location: index.php?v=posts');
}

if (!isset($_GET['id'])) {
	header('location: index.php?v=posts');
}

	$result = $pdo->query('SELECT `id`, `name` FROM `categories`');
	$categories = $result->fetchAll();


	$result = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
	$result->bindParam('id', $_GET['id']);
	$result->execute();

	$post = $result->fetch();

 ?>
<form method="POST">
	<div class="form-group">
		<label for="Nazwa kategorii">Tytuł</label>
		<input type="text" name="title" value="<?php echo $post['title'] ?>" class="form-control">
	</div>
	<div class="form-group">
		<label for="Nazwa kategorii">Treść</label>
		<textarea name="body" cols="30" rows="10"  class="form-control"><?php echo $post['body'] ?></textarea> 
	</div>
		<div class="form-group">
		<label for="Nazwa kategorii">Kategoria</label>
		<select name="category_id" id="" value="<?php echo $category['name'] ?>" class="form-control">
		<?php
		foreach ($categories as $category) {
			if ($post['category_id'] == $category['id'] ) {
				echo '<option selected value="'. $category['id'] .'">';
			}
			else{
				echo '<option value="'. $category['id'] .'">';
			}
			
			echo $category['name'];
			echo '</option>';
		}

		  ?>
		>
		</select>
		
	</div>
		<div class="form-group">
			<button class="btn btn-primary">Zapisz</button>
		</div>	
</form>