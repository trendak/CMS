<?php
if(isset($_POST['name'])){
	$result = $pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
	$result->bindParam(':name', $_POST['name']);
	$result->execute();

	header('location: index.php?v=categories');
}

 ?>


<h1>Dodawania kategori</h1>
<form method="POST">
	<div class="form-control">
		<label for="Nazwa kategorii">Nazwa Kategorii</label>
		<input type="text" name="name" class="form-control">
	</div>
		<div class="form-control">
			<button class="btn btn-primary">Zapisz</button>
		</div>	
</form>