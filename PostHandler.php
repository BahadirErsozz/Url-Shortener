<?php 

require_once("DataBase.php");
$data_base = new DataBase();
if(array_key_exists("url", $_POST)){
    var_dump($data_base->create($_POST["url"]));
}
?>