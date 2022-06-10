<?php 

require_once("DataBase.php");
$data_base = new DataBase();
echo $data_base->create($_POST["url"]);

?>