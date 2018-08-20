<?php
include 'db/pdo.php';
include 'utils/utils.php';
session_start();

?>

<?php
if($_SESSION['login'])
{
if (array_key_exists('v', $_GET)) {
	$module = $_GET['v'];
} else {
    if (isset($_SESSION['admin']))
	$module = 'posts';
    else{
        $module = 'home';
    }
}
if (isset($_SESSION['admin']))
{
    if ($_SESSION['admin'] == true)
        $moduleDir = 'modules/admin/' . $module . '.php';
    else
        $moduleDir = 'modules/user/' . $module . '.php';
}
else
    $moduleDir = 'modules/user/' . $module . '.php';


if (file_exists($moduleDir)) {
	ob_start();
	include $moduleDir;
	$content = ob_get_contents();
	ob_end_clean();
    if (isset($_SESSION['admin']))
    {
        include 'layouts/admin.php';
    }
    elseif(!isset($_SESSION['admin']) || $_SESSION['admin'] == false){
        include 'layouts/user.php';
    }


} else {
	header("HTTP/1.1 404 Not Found");
}

if (isset($_GET['logout']) == 1) {


    @session_destroy();
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    if (isset($_SESSION['admin'])){
        $_SESSION['admin'] = false;
    }
    header('refresh: 1;');
}

?>