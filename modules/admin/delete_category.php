<?php
if (!isset($_GET['id'])) {
	header('location: index.php?v=categories');
}

$result = $pdo->prepare('SELECT id FROM categories WHERE id = :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();
$category = $result->fetch();
if ($category) {
	$result = $pdo->prepare('DELETE FROM categories WHERE id = :id');
	$result->bindParam(':id', $_GET['id']);
	$result->execute();
	header('location: index.php?v=categories');
} else {
	header('location: index.php?v=categories');
}

?>