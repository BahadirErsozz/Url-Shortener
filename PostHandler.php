<?php 

if(!isset($_SESSION)) session_start();

if(!array_key_exists("urls", $_SESSION)){
    $_SESSION["urls"] = [];
}

require_once("DataBase.php");
$data_base = new DataBase();
if(array_key_exists("url", $_POST)){
    $data = $data_base->create($_POST["url"]);
    if($data["url_created"]){
        array_unshift($_SESSION["urls"], $data);
    }
}
if(array_key_exists("urls", $_SESSION)){
    if(is_array($_SESSION["urls"])){
        foreach($_SESSION["urls"] as $url){
            echo "
            <div class=\"link\"> 
                <div class=\"original-url\">
                    {$url["original_url"]}
                </div>
                <div class=\"short-url\">
                    <a href=\"{$url["short_url"]}\">
                    {$_SERVER['HTTP_HOST']}/{$url["short_url"]}
                    </a>
                </div>
            </div>";
        }
    }
}
?>