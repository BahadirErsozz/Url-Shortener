<?php 

require_once("DataBase.php");
$data_base = new DataBase();
var_dump($data_base->create($_POST["url"]));

?>