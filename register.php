<?php 
if(array_key_exists("username", $_POST) && array_key_exists("password", $_POST) && array_key_exists("email", $_POST)){
    require_once("DataBaseUsers.php");
    $db = new DataBaseUsers();
    $user = $db->register($_POST["username"], $_POST["email"], $_POST["password"]);

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
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        body {
            background: #3e4144;
        }
    </style>
</head>
<body>
<form class="form-register" action="" method="POST">
        <h1 class="login-title">Register</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">

        <?php 
        
        if(isset($error_message)){
            echo "<h1 style=\"color: red; font-size: 20px;\"> {$error_message}</h1>";
        }
        if(isset($username)){
            header("Location: index.php");
        }
        ?>

        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link-register"><a href="login.php">Click to Login</a></p>
    </form>
</body>
</html>