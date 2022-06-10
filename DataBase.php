<?php 
class DataBase{
    public $conn;
    public $server_name = "127.0.0.1";
    public $username = "root";
    public $password = "";
    public $database_name = "url_links";

    public function __construct(){
        $this->conn = mysqli_connect($this->server_name,$this->username,$this->password,$this->database_name,4306);
    }
    public function create($url){
        //INSERT INTO `links` (`id`, `user_id`, `original_url`, `converted_url`) VALUES (NULL, '1', 'https://google.com', '1');
        $query = "INSERT INTO `links` (`id`, `user_id`, `original_url`, `converted_url`) VALUES (NULL, '1', '". $url ."', '1');";

        mysqli_query($this->conn, $query);
        return $url;
    }
}
?>