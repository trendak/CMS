<?php
if(isset($_POST['name'])){
	$result = $pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
	$result->bindParam(':name', $_POST['name']);
	$result->bindParam(':id', $_GET['id']);
	$result->execute();

	header('location: index.php?v=categories');
}

if (!isset($_GET['id'])) {
	header('location: index.php?v=categories');
}
	$result = $pdo->prepare('SELECT * FROM categories WHERE id = :id');
	$result->bindParam('id', $_GET['id']);
	$result->execute();

$category = $result->fetch();
if (empty($category)) {
	header('location: index.php?v=categories');
}


 ?>


<h1>Edytowanie kategorii</h1>
<form method="POST">
	<div class="form-control">
		<label for="Nazwa kategorii">Nazwa Kategorii</label>
		<input type="text" name="name" value="<?php echo $category['name'] ?>" class="form-control">
	</div>
		<div class="form-control">
			<button class="btn btn-primary">Zapisz</button>
		</div>	
</form>