<?php
/*
 * Name:Alex Fleming
 * Title: process_post.php
 * Description: This file handles the processing of some action from the create.php file, where there is a link to this page.
 *
 */

require 'connect.php';

if ($_POST['command'] == 'Create') {
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

         // Build the parameterized SQL query and bind sanitized values to the parameters
         $query     = "INSERT INTO blog (title, content, id) values (:title, :content, :id)";
         $statement = $db->prepare($query);
         $statement->bindValue(':title', $title);
         $statement->bindValue(':content', $content);
         $statement->bindValue(':id', $id, PDO::PARAM_INT);

         // Execute the INSERT prepared statement.
         $statement->execute();

         // Determine the primary key of the inserted row.
         $insert_id = $db->lastInsertId();

        if (isset($error_message)) {
          header("Location: create.php?error=" . $error_message);
        }
        else
        {
        header("Location: index.php");
        }
        exit(0);
}
?>
