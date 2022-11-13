<?php
/*
 * Name:Alex Fleming
 * Title: create.php
 * Description: This file has the code needed for using the "New Entry" part of the website to
 * make new posts to skateboard database.
 *
 */

require ('authenticate.php');
$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Deck Rating System ::</title>
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
      <h1><a href="index.php">New Deck Entry Form</a></h1>
    </div>
    <ul id="menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="create.php" class='active'>New Entry</a></li>
    </ul>
    <div id="all_entries">
      <form action="process_post.php" method="post">
        <fieldset>
          <legend>New Deck Entry Form</legend>
          <p>
            <label for="title">Title</label>
            <input name="title" id="title" />
          </p>
          <p>
            <label for="brand">Brand</label>
            <input name="brand" id="brand" />
          </p>
          <p>
            <label for="length">Length (in cm)</label>
            <input name="length" id="length" />
          </p>
          <p>
            <label for="width">Width (in cm)</label>
            <input name="width" id="width" />
          </p>
          <p>
            <label for="release_year">Release Year</label>
            <input name="release_year" id="release_year" />
          </p>
          <p>
            <label for="year_used">Year of Use</label>
            <input name="year_used" id="year_used" />
          </p>
          <p>
            <label for="rating">Rating</label>
            <input name="rating" id="rating" />
          </p>
          <p>
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes"></textarea>
          </p>
          <p>
            <input type="submit" name="command" value="Create" />
          </p>
        </fieldset>
      </form>
    </div>
    <div id="footer">2022 - Copyright™</div>
  </div>
</body>
</html>
