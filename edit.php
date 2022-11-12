<?php
/*
 * Name:Alex Fleming
 * Title: edit.php
 * Description: This file has code related to using the edit portion of the webpage.
 *
 */

require ('authenticate.php');
require('connect.php');

$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);

    if(isset($_GET['id'])) {
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

      // Build the parametrized SQL query using the filtered id.
      $query = "SELECT * FROM blog WHERE id=:id";
      $statement = $db->prepare($query);
      $statement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execute the SELECT and fetch the single row returned.
      $statement->execute();
      $blog = $statement->fetchAll();

    }else{

        if ($_POST['command'] == 'Update')
        {
            // Sanitize user input to escape HTML entities and filter out dangerous characters.
            $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            if (empty($title)) {
              $error_message = "Post title must not be empty";
            }

            if (empty($content)) {
              $error_message = "Content must not be empty";
            }

            // Build the parameterized SQL query and bind the sanitized values to the parameters
            $query     = "UPDATE blog SET title = :title, content = :content WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':content', $content);
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

            //header("Location: index.php");
            //exit(0);
        } elseif ($_POST['command'] == 'Delete') {

          // Sanitize user input to escape HTML entities and filter out dangerous characters.
          $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

          // Build the parameterized SQL query and bind to the above sanitized values.
          $query     = "DELETE FROM blog WHERE id = :id";
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
            <legend>Edit Blog Post</legend>
            <!-- Hidden input for the quote primary key. -->
            <input type="hidden" name="id" value="<?= $blog[0]['id'] ?>">
            <!-- Quote author and content are echoed into the input value attributes. -->
            <label for="title">Title</label>
            <input id="title" name="title" value="<?= $blog[0]['title'] ?>">
            <label for="content">Content</label>
            <input id="content" name="content" value="<?= $blog[0]['content'] ?>">
            <!-- <input type="hidden" name="id" value="2303" /> -->
            <input type="submit" name="command" value="Update" />
            <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
          </fieldset>
        </form>
    <?php else: ?>
        <p>No quote selected. <a href="?id=0">Try this link</a>.</p>
    <?php endif ?>
</div>
<!--
//added from stung eye edited -->
</body>
</html>
