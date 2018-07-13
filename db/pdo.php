<?php
$pdo = new PDO('mysql:host=localhost;dbname=php_cms_001;encoding=utf8', 'root', '1234');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


  ?>