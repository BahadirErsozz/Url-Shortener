<!DOCTYPE html>
<html>
  <head>
    <title>URL Shortener</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <header>
    <div class="top-container">
      <h1> <a href="">Url Shortener</a></h1>
    </div>
  </header>
    <main>
      <section class="url-box">
        <h2> Paste the URL</h2>
        <form action="PostHandler.php" method="POST">
            <input
              id="url_input"
              type="text"
              name="url"
              placeholder="Enter the URL here"
            />
            <input type="submit" value="Shorten URL" />
        
        </form>
      </section>
    </main>
  </body>
</html>
