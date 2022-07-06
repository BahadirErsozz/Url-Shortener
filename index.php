<?php 
if(!isset($_SESSION)) session_start();

if(array_key_exists("logout", $_POST)){
  session_unset();
  session_destroy();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>URL Shortener</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <header>
      <div class="top-menu">
        <?php 
          if(!array_key_exists("user_id", $_SESSION)){
            echo "
              <button type=\"button\" class=\"top-button\">
                <a href=\"login.php\">login
                </a>
              </button>
              <button type=\"button\" class=\"top-button\">
                <a href=\"register.php\">register
                </a>
              </button>  
            ";
          }
          else{
            echo "<div style=\"display: flex;\">
              <p style=\"padding: 2px; margin: 5px 0px;\"> Welcome ". $_SESSION["username"] ." </p> 
              <form method=\"POST\" style=\"padding: 0px 10px;\">
                <input type=\"submit\" name=\"logout\" value=\"logout\" style=\"all: revert; padding: 10px 20px;\" />
              </form>
              </div>
            ";
          }
          
        ?>
      </div>
    <div class="top-container">
      <h1> <a href="">Url Shortener</a></h1>
    </div>
  </header>
    <main>
      <section class="url-box">
        <h2> Paste the URL</h2>
        <form action="" method="POST">
            <input
              id="url_input"
              type="text"
              name="url"
              placeholder="Enter the URL here"
            />
            <input type="submit" value="Shorten URL" />
            
        
        </form>
        <div class="links">
        <?php 
        require "PostHandler.php";  
        ?>
        </div>

      </section>
    </main>
  </body>
</html>
