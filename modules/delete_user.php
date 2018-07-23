<?php
if (!isset($_GET['id'])) {
	header('location: index.php?v=posts');
}

$result = $pdo->prepare('SELECT id FROM users WHERE id = :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();
$user = $result->fetch();
if ($user) {
	$result = $pdo->prepare('DELETE FROM users WHERE id = :id');
	$result->bindParam(':id', $_GET['id']);
	$result->execute();
    howManyRecords();
	header('location: index.php?v=users');
} else {
	header('location: index.php?v=users');
}

?>