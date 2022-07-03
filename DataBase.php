<?php 
class DataBase{
    protected $conn;

    public function __construct(){
        require_once("config.php");
        $mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME,4306);
        if($mysqli->connect_error){
            throw new Exception('Connect Error ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error, $mysqli->connect_errno);
        }
        $this->conn = $mysqli;
    }
    public function create($url){

        if(!$this->validate_url($url)){
            echo $url ." is not a valid url";
            return [
                "url_created" => false
            ];
        }
        $shortened_url = substr(md5(microtime()), rand(0,26), 5);
        $query = "INSERT INTO `url_links` (`id`, `user_id`, `original_url`, `shortened_url`) VALUES (NULL, '', '". $url ."', '". $shortened_url ."');";
        if(mysqli_query($this->conn, $query)){
            return [
                "url_created" => true,
                "short_url" => $shortened_url,
                "original_url" => $url
            ];
            
        }
        throw new Exception("an error occured with the server");
        
    }


    public function getLastId(){
        $result = mysqli_query($this->conn, "SELECT * FROM `url_links` ORDER BY `url_links`.`id` DESC");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == "NULL"){
            return 1;
        }
        return $result["id"];
    }

    public function getOriginalUrlIfExists($url){
        $result = mysqli_query($this->conn, "SELECT * FROM `url_links` WHERE `original_url` = '". $url ."'");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == NULL){
            return -1;
        }
        return $result["shortened_url"];
    }
    public function redirectToUrl($uri){
        $result = mysqli_query($this->conn, "SELECT * FROM `url_links` WHERE `shortened_url` = '". $uri ."'");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == NULL){
            require '404.php';
            return;
        }
        header("Location: " . $result["original_url"]);
    }
    function validate_url($url) {
        // Remove all illegal characters from a url
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Validate url 
        return filter_var($url, FILTER_VALIDATE_URL);

    }

}
?>