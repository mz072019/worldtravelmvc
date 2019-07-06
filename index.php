<?php session_start();
require_once('app/db.php');
if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING);
	$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
} 
else {
	$controller = 'pages';
	$action     = 'home';
}
require_once('app/views/layout.php');
?>