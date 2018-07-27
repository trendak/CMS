<?php
include 'db/pdo.php';
include 'utils/utils.php';
session_start();

?>

<?php
if (array_key_exists('v', $_GET)) {
	$module = $_GET['v'];
} else {
	$module = 'categories';
}

$moduleDir = 'modules/' . $module . '.php';

if (file_exists($moduleDir)) {
	ob_start();
	include $moduleDir;
	$content = ob_get_contents();
	ob_end_clean();
    if (isset($_SESSION['admin']))
    {
        include 'layouts/admin.php';
    }
    else{
        include 'layouts/user.php';
    }


} else {
	header("HTTP/1.1 404 Not Found");
}

//wylogowanie
if (isset($_GET['logout']) == 1) {
	$_SESSION['loged'] = false;
	session_destroy();
	$page = $_SERVER['PHP_SELF'];
	$sec = "0";
	header("Refresh: $sec; url=$page");
}
?>