<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        header("Location: index.php");
        break;
    case '' :
        header("Location: index.php");
        break;
    case '/router.php':
        header("Location: index.php");
        break;
    default:
        require_once 'DataBaseUrlLinks.php';
        $db = new DataBaseUrlLinks();
        $db->redirectToUrL($_GET["query"]);
        break;
}

?>