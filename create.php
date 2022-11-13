<?php
/*
 * Name:Alex Fleming
 * Title: create.php
 * Description: This file has the code needed for using the "New Post" part of the website to make new posts.
 *
 */

require ('authenticate.php');
$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>J. Twotwo's blog - New Post ::</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <div id="wrapper">

<?php if (isset($error)) { ?>
  <div id="error_message">
    <p><?= $error ?></p>
  </div>
<?php } ?>

    <div id="header">
      <h1><a href="index.php">J. Twotwo Blog - New Post</a></h1>
    </div>
    <ul id="menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="create.php" class='active'>New Post</a></li>
    </ul>
    <div id="all_blogs">
      <form action="process_post.php" method="post">
        <fieldset>
          <legend>New Blog Post</legend>
          <p>
            <label for="title">Title</label>
            <input name="title" id="title" />
          </p>
          <p>
            <label for="content">Content</label>
            <textarea name="content" id="content"></textarea>
          </p>
          <p>
            <input type="submit" name="command" value="Create" />
          </p>
        </fieldset>
      </form>
    </div>
    <div id="footer">
      2022 - No Rights
    </div>
  </div>
</body>
</html>
