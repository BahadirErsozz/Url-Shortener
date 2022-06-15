<?php 
class DataBase{
    public $conn;
    public $server_name = "127.0.0.1";
    public $username = "root";
    public $password = "";
    public $database_name = "url_links";

    public function __construct(){
        require_once("config.php");
        $mysqli = mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME,4306);
        if($mysqli->connect_error){
            throw new Exception('Connect Error ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error, $mysqli->connect_errno);
        }
        $this->conn = $mysqli;
    }
    public function create($url){
        require_once("Shortener.php");

        if($this->getUrlIfExists($url) != -1){
            return $this->getUrlIfExists($url);
        }

        $last_id = $this->getLastId();
        $shortened_url = getShortenedURLFromID($last_id + 1);
        $query = "INSERT INTO `links` (`id`, `user_id`, `original_url`, `shortened_url`) VALUES (NULL, '', '". $url ."', '". $shortened_url ."');";
        if(mysqli_query($this->conn, $query)){
            return [
                "shortened_url" => $shortened_url,
                "response_code" => 200
            ];
        }
        return [
            "response_code" => 500,
            "error_message" => "couldn't create the short URL"
        ]; 
        
    }


    public function getLastId(){
        $result = mysqli_query($this->conn, "SELECT * FROM `links` ORDER BY `links`.`id` DESC");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == "NULL"){
            return 1;
        }
        return $result["id"];
    }

    public function getUrlIfExists($url){
        $result = mysqli_query($this->conn, "SELECT * FROM `links` WHERE `original_url` = '". $url ."'");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == NULL){
            return -1;
        }
        return $result["shortened_url"];
    }
}
?>