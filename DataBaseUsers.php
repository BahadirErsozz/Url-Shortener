<?php 
class DataBaseUsers{

    protected $conn;

    public function __construct(){
        require_once("config.php");
        $mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME,4306);
        if($mysqli->connect_error){
            throw new Exception('Connect Error ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error, $mysqli->connect_errno);
        }
        $this->conn = $mysqli;
    }

    public function login($username, $password){
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = ?;");
        $query->bind_param("s", $username);
        $query->execute();
        $user = $query->get_result();
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);
        if($user == NULL){
            return [
                "error_code" => 404,
                "error_message" => "username does not exist"
            ];
        }
        if($user["password"] != md5($password)){
            return[
                "error_code" => 401,
                "error_message" => "wrong password"
            ]; 
        }
        return [
            "username" => $username,
            "user_id" => $user["user_id"]
        ];
    }

    public function register($username, $email, $password){
        if ( !preg_match('/^[A-Za-z][A-Za-z0-9_]{5,31}$/', $username) ){
            return [
                'error_code' => 400,
                'error_message' => 'username must start with a letter, 6-32 characters, Letters, numbers and \"_\" only'
            ];
        }
        // if the password is invalid
        if(!preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $password)){
            return [
                'error_code' => 400,
                'error_message' => "password nedds to contain at least (1) upper case letter, (1) lower case letter, (1) number or special character, (8) characters in length"
            ];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'error_code' => 400,
                'error_message' => "invalid email format"
            ];
        }
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = ?;");
        $query->bind_param("s", $username);
        $query->execute();
        $user = $query->get_result();
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);
        if($user != NULL){
            return [
                "error_code" => 400,
                "error_message" => "username is already taken"
            ];
        }
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = ?;");
        $query->bind_param("s", $email);
        $query->execute();
        $user = $query->get_result();
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);
        if($user != NULL){
            return [
                "error_code" => 400,
                "error_message" => "you can only create one account per email"
            ];
        }
        $query = $this->conn->prepare("INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`) VALUES (NULL, ?, ?, ?, ". "current_timestamp()" . ");");
        $query->bind_param("sss", $username, md5($password), $email);
        $result = $query->execute();
        if($result){
            return $this->login($username, $password);
        }
        return [
            "error_code" => 500,
            "error_message" => "an error occured with the server"
        ];
    }


}

?>