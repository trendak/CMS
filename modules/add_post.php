<h1>Dodawanie postów</h1>
<?php 

	if(isset($_POST['title'])){
	$result = $pdo->prepare('INSERT INTO posts (title, body, category_id) VALUES (:title, :body, :category_id)');
	$result->bindParam(':title', $_POST['title']);
	$result->bindParam(':body', $_POST['body']);
	$result->bindParam(':category_id', $_POST['category_id']);
	$result->execute();

	header('location: index.php?v=posts');
}

	$result = $pdo->query('SELECT `id`, `name` FROM `categories`');
	$categories = $result->fetchAll();

 ?>

<form method="POST">
	<div class="form-control">
		<label for="Nazwa kategorii">Tytuł</label>
		<input type="text" name="title" class="form-control">
	</div>
	<div class="form-control">
		<label for="Nazwa kategorii">Treść</label>
		<textarea name="body" cols="30" rows="10" class="form-control"></textarea> 
	</div>
		<div class="form-control">
		<label for="Nazwa kategorii">Kategoria</label>
		<select name="category_id" id="" class="form-control">
		<?php
		foreach ($categories as $category) {
			echo '<option value="'. $category['id'] .'">';
			echo $category['name'];
			echo '</option>';
		}

		  ?>
		>
		</select>
		
	</div>
		<div class="form-control">
			<button class="btn btn-primary">Zapisz</button>
		</div>	
</form>