<?php 
class DataBaseUrlLinks{

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
        $query = $this->conn->prepare("INSERT INTO `url_links` (`id`, `user_id`, `original_url`, `shortened_url`) VALUES (NULL, ?, ?, ?);");
        // have to create a variable because bind_param function requires it
        $user_id = array_key_exists("user_id", $_SESSION) ? $_SESSION["user_id"] : -1;
        $query->bind_param("iss", $user_id, $url, $shortened_url);
        if($query->execute()){
            return [
                "url_created" => true,
                "shortened_url" => $shortened_url,
                "original_url" => $url
            ];
            
        }
        throw new Exception("an error occured with the server");
        
    }


    public function getLastId(){
        $result = mysqli_query($this->conn, "SELECT * FROM `url_links` ORDER BY `url_links`.`id` DESC;");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == "NULL"){
            return 1;
        }
        return $result["id"];
    }

    public function getOriginalUrlIfExists($url){
        $query = $this->conn->prepare("SELECT * FROM `url_links` WHERE `original_url` = ?;");
        $query->bind_param("s", $url);
        $query->execute();
        $result = $query->get_result();
        //$result = mysqli_query($this->conn, "SELECT * FROM `url_links` WHERE `original_url` = '". $url ."';");
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($result == NULL){
            return -1;
        }
        return $result["shortened_url"];
    }
    public function redirectToUrl($uri){
        $query = $this->conn->prepare("SELECT * FROM `url_links` WHERE `shortened_url` = ?;");
        $query->bind_param("s", $uri);
        $query->execute();
        $result = $query->get_result();
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
    function getUrlsByUserId($user_id){
        $query = $this->conn->prepare("SELECT * FROM `url_links` WHERE `user_id` = ?;");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();

        $toReturn = [];
        if($result){
            // Cycle through results
           while ($row = $result->fetch_assoc()){
                array_push($toReturn, $row);   
           }
       }
       return $toReturn;
        
    }

}
?>