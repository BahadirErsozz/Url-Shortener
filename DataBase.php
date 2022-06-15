<?php 
class DataBase{
    public $conn;
    public $server_name = "127.0.0.1";
    public $username = "root";
    public $password = "";
    public $database_name = "url_links";

    public function __construct(){
        require_once("config.php");
        $this->conn = mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME,4306);
    }
    public function create($url){
        require_once("config.php");
        require_once("Shortener.php");
        //INSERT INTO `links` (`id`, `user_id`, `original_url`, `converted_url`) VALUES (NULL, '1', 'https://google.com', '1');
        $last_id =mysqli_query($this->conn, "SELECT * FROM `links`");
        return $last_id;
        //$query = "INSERT INTO `links` (`id`, `user_id`, `original_url`, `converted_url`) VALUES (NULL, '1', '". $url ."', '". getShortenedURLFromID() ."');";

        mysqli_query($this->conn, $query);
        return $url;
    }
}
?>