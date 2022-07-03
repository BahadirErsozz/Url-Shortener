<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require  'index.php';
        break;
    case '' :
        require  'index.php';
        break;
    case '/router.php':
        require  'index.php';
        break;
    default:
        require_once 'DataBase.php';
        $db = new DataBase();
        $db->redirectToUrL($_GET["query"]);
        break;
}

?>