<?php 
if(array_key_exists("username", $_POST) && array_key_exists("password", $_POST)){
    require_once("DataBaseUsers.php");
    $db = new DataBaseUsers();
    $user = $db->login($_POST["username"], $_POST["password"]);

    if(!array_key_exists("error_message", $user)){
        $username = $user["username"];
        if(!isset($_SESSION)) session_start();
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
    }
    else{
        $error_message = $user["error_message"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        body {
            background: #3e4144;
        }
    </style>
</head>
<body>
    <form class="form-login" method="POST" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        
        <?php 
        if(isset($error_message)){
            echo "<h1 style=\"color: red; font-size: 20px;\"> {$error_message}</h1>";
        }
        if(isset($username)){
            echo "<h1 style=\"color: green; font-size: 20px\"> welcome {$username}</h1>";
            sleep(1);
            header("Location: index.php");
        }
        ?>
        
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link-login"><a href="register.php">New Registration</a></p>
  </form>
</body>
</html>