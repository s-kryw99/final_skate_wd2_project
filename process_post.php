<?php
/*
 * Name:Alex Fleming
 * Title: process_post.php
 * Description: This file handles the processing of some action from the create.php file,
 * Note: This file is part of 'create.php' form input processing.
 * where there is a link to this page.
 *
 */

require 'connector.php';

if ($_POST['command'] == 'Create') {
        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $brand  = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
          $error_message = "brand must not be empty";
        }

        if (empty($rating)) {
          $error_message = "rating must not be empty";
        }

        if (empty($length)) {
          $error_message = "length must not be empty";
        }

        if (empty($width)) {
          $error_message = "width must not be empty";
        }

        if (empty($release_year)) {
          $error_message = "release year must not be empty";
        }

        if (empty($year_used)) {
          $error_message = "year of use must not be empty";
        }

        if (empty($notes)) {
          $error_message = "Content must not be empty";
        }

         // Build the parameterized SQL query and bind sanitized values to the parameters
         $query     = "INSERT INTO final_skate (title, brand, rating, length, width, release_year, year_used, notes, id) values (:title, :brand, :rating, :length, :width, :release_year, :year_used, :notes, :id)";

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
