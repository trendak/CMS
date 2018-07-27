<?php
if (!isset($_GET['id'])) {
    header('location: index.php?v=pages');
}


$result = $pdo->prepare('SELECT id FROM pages WHERE id = :id');
$result->bindParam(':id', $_GET['id'] );
$result->execute();
$page = $result->fetch();
if ($page) {
    $result = $pdo->prepare('DELETE FROM pages WHERE id = :id');
    $result->bindParam(':id', $_GET['id'] );
    $result->execute();
    howManyRecords();
    header('location: index.php?v=pages');

}
else{
    header('location: index.php?v=pages');
}


?>