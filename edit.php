<?php
/*
 * Name:Alex Fleming
 * Title: edit.php
 * Description: This file has code related to using the edit portion of the webpage.
 *
 */

require ('authenticate.php');
require('connector.php');

$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);

    if(isset($_GET['id'])) {
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

      // Build the parametrized SQL query using the filtered id.
      $query = "SELECT * FROM final_skate WHERE id=:id";
      $statement = $db->prepare($query);
      $statement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execute the SELECT and fetch the single row returned.
      $statement->execute();
      $skate_or_die = $statement->fetchAll();

    }

    else
    {
        if ($_POST['command'] == 'Update')
        {
            // Sanitize user input to escape HTML entities and filter out dangerous characters.
            $title   = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $brand   = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $rating  = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $length       = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);
            $width        = filter_input(INPUT_POST, 'width', FILTER_SANITIZE_NUMBER_INT);

            $release_year = filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_NUMBER_INT);
            $year_used  = filter_input(INPUT_POST, 'year_used', FILTER_SANITIZE_NUMBER_INT);

            $notes  = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            if (empty($title)) {
              $error_message = "Post title must not be empty";
            }

            if (empty($brand)) {
              $error_message = "Post brand must not be empty";
            }

            if (empty($rating)) {
              $error_message = "Post rating must not be empty";
            }

            if (empty($length)) {
              $error_message = "Post length must not be empty";
            }

            if (empty($width)) {
              $error_message = "Post width must not be empty";
            }

            if (empty($release_year)) {
              $error_message = "Post release year must not be empty";
            }

            if (empty($year_used)) {
              $error_message = "Post year used must not be empty";
            }

            if (empty($notes)) {
              $error_message = "Content must not be empty";
            }

            // Build the parameterized SQL query and bind the sanitized values to the parameters
            $query     = "UPDATE final_skate SET title = :title, brand = :brand, rating = :rating, length = :length, width = :width, release_year = :release_year, year_used = :year_used, notes = :notes WHERE id = :id";

            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':brand', $brand);
            $statement->bindValue(':rating', $rating);

            $statement->bindValue(':length', $length);
            $statement->bindValue(':width', $width);

            $statement->bindValue(':release_year', $release_year);
            $statement->bindValue(':year_used', $year_used);

            $statement->bindValue(':notes', $notes);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            // Execute the INSERT.
            $statement->execute();

            if (isset($error_message)) {
              header("Location: edit.php?error=" . $error_message . "&id=" . $id);
            }
            else
            {
            header("Location: index.php");
            }
            exit(0);


        } elseif ($_POST['command'] == 'Delete') {

          // Sanitize user input to escape HTML entities and filter out dangerous characters.
          $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $brand  = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $rating  = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

          $length = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);
          $width  = filter_input(INPUT_POST, 'width', FILTER_SANITIZE_NUMBER_INT);
          $release_year = filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_NUMBER_INT);
          $year_used  = filter_input(INPUT_POST, 'year_used', FILTER_SANITIZE_NUMBER_INT);

          $content = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

          // Build the parameterized SQL query and bind to the above sanitized values.
          $query     = "DELETE FROM final_skate WHERE id = :id";
          $statement = $db->prepare($query);
          $statement->bindValue(':id', $id, PDO::PARAM_INT);

          // Execute the INSERT.
          $statement->execute();


          header("Location: index.php");

          exit(0);
        }
      }

?>
<!DOCTYPE html>
<html>
<head>
    <title>PDO Update</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

  <?php if (isset($error)) { ?>
    <div id="error_message">
      <p><?= $error ?></p>
    </div>
  <?php } ?>

<ul id="menu">
    <li><a href="index.php">Home</a></li>
    <li><a href="create.php">New Post</a></li>
</ul>
<div>
  <?php if ($id): ?>
        <form method="post" action="edit.php">
          <fieldset>
            <legend>Edit Deck Entry</legend>
            <!-- Hidden input for the quote primary key. -->
            <input type="hidden" name="id" value="<?= $skate_or_die[0]['id'] ?>">
            <!-- Quote author and content are echoed into the input value attributes. -->

            <label for="title">Title</label>
            <input id="title" name="title" value="<?= $skate_or_die[0]['title'] ?>">

            <label for="brand">Brand</label>
            <input id="brand" name="brand" value="<?= $skate_or_die[0]['brand'] ?>">

            <label for="rating">Rating</label>
            <input id="rating" name="rating" value="<?= $skate_or_die[0]['rating'] ?>">

            <label for="length">Length (in inches)</label>
            <input id="length" name="length" value="<?= $skate_or_die[0]['length'] ?>">

            <label for="width">Width (in inches)</label>
            <input id="width" name="width" value="<?= $skate_or_die[0]['width'] ?>">

            <label for="release_year">Release Year</label>
            <input id="width" name="width" value="<?= $skate_or_die[0]['release_year'] ?>">

            <label for="year_used">Year Used</label>
            <input id="width" name="width" value="<?= $skate_or_die[0]['year_used'] ?>">

            <label for="notes">Notes</label>
            <input id="notes" name="notes" value="<?= $skate_or_die[0]['notes'] ?>">
            <!-- <input type="hidden" name="id" value="2303" /> -->

            <input type="submit" name="command" value="Update" onclick="return confirm('Ok...I guess thats the best you can do...')" />
            <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
          </fieldset>
        </form>

    <?php else: ?>
        <p>No entry selected. <a href="?id=0">Try this link</a>.</p>
    <?php endif ?>

</div>
</body>
</html>
