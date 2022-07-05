<?php 

if(!isset($_SESSION)) session_start();

require_once("DataBaseUrlLinks.php");
$db = new DataBaseUrlLinks();

if(array_key_exists("user_id", $_SESSION)){
    $_SESSION["urls"] = $db->getUrlsByUserId($_SESSION["user_id"]);
}

if(!array_key_exists("urls", $_SESSION)){
    $_SESSION["urls"] = [];
}


if(array_key_exists("url", $_POST)){
    $data = $db->create($_POST["url"]);
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
                    <a href=\"{$url["shortened_url"]}\">
                    {$_SERVER['HTTP_HOST']}/{$url["shortened_url"]}
                    </a>
                </div>
            </div>";
        }
    }
}
?>