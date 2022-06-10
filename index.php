<!DOCTYPE html>
<html>
  <head>
    <title>URL Shortener</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <h1>URL Shortener Microservice</h1>
    <h2>Short URL Creation</h2>
    <p>
      Example: <code>POST [project_url]/api/shorturl</code> -
      <code>https://www.google.com</code>
    </p>
    <main>
      <section>
        <form action="PostHandler.php" method="POST">
          <fieldset>
            <legend>URL Shortener</legend>
            <label for="url_input">URL:</label>
            <input
              id="url_input"
              type="text"
              name="url"
              placeholder="https://www.google.com"
            />
            <input type="submit" value="POST URL" />
          </fieldset>
        </form>
      </section>
    </main>
  </body>
</html>
