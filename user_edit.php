<?php
/*
 * Name:Alex Fleming
 * Title:
 * Description:
 *
 */

 // require 'exit_page.php';
 require 'connect.php';
 require 'header.php';
 #require 'home_create_menu.php';
 // require 'admin_header.php';



$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);

    if(isset($_GET['id'])) {
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

      // Build the parametrized SQL query using the filtered id.
      $query = "SELECT * FROM users WHERE id=:id";
      $statement = $db->prepare($query);
      $statement->bindValue(':id', $id, PDO::PARAM_INT);

      // Execute the SELECT and fetch the single row returned.
      $statement->execute();
      $reguser = $statement->fetchAll();

    }else{

        if ($_POST['command'] == 'Update')
        {
            // Sanitize user input to escape HTML entities and filter out dangerous characters.
            $user_pass  = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_pass  = password_hash($user_pass, PASSWORD_DEFAULT);
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            if (empty($user_pass)) {
              $error_message = "Post title must not be empty";
            }

            if (empty($user_email)) {
              $error_message = "Content must not be empty";
            }

            if (empty($user_name)) {
              $error_message = "Content must not be empty";
            }

            // Build the parameterized SQL query and bind the sanitized values to the parameters
            $query     = "UPDATE users SET user_name = :user_name, user_email = :user_email, user_pass = :user_pass WHERE id = :id";

            $statement = $db->prepare($query);
            $statement->bindValue(':user_name', $user_name);
            $statement->bindValue(':user_pass', $user_pass);
            $statement->bindValue(':user_email', $user_email);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            // Execute the INSERT.
            $statement->execute();
                    header("location: user_control.php");

            if (isset($error_message)) {
              header("Location: edit.php?error=" . $error_message . "&id=" . $id);
            }
            else
            {
              header("location: user_control.php");
            }
            exit(0);


        } elseif ($_POST['command'] == 'Delete') {

          // Sanitize user input to escape HTML entities and filter out dangerous characters.
          $user_name  = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $user_pass  = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $password  = password_hash($password, PASSWORD_DEFAULT);
          $id         = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

          // Build the parameterized SQL query and bind to the above sanitized values.
          $query     = "DELETE FROM users WHERE id = :id";
          $statement = $db->prepare($query);
          $statement->bindValue(':id', $id, PDO::PARAM_INT);

          // Execute the INSERT.
          $statement->execute();
          header("location: user_control.php");
          // header("Location: admin_landing.php");
          exit(0);
        }
      }
?>


  <?php if (isset($error)) { ?>
    <div id="error_message">
      <p><?= $error ?></p>
    </div>
  <?php } ?>
<div>
  <?php if ($id): ?>
        <form method="post" action="user_edit.php">
          <fieldset>
            <legend>Edit Users</legend>
            <!-- Hidden input for the table primary key. -->
            <input type="hidden" name="id" value="<?= $reguser[0]['id'] ?>">
            <!--  email, username and password are echoed into the input value attributes. -->
            <label for="user_email">Email</label>
            <input id="user_email" name="user_email" value="<?= $reguser[0]['user_email'] ?>">
            <br /><br />
            <label for="user_name">User Name</label>
            <input id="user_name" name="user_name" value="<?= $reguser[0]['user_name'] ?>">
            <br />      <br />
            <label for="user_pass">Password</label>
            <input id="user_pass" name="user_pass" value="">
            <br />      <br />
            <button id= "user" type="submit" name= "command" value= "Update" >Update????</button>
            <button id= "user" type="submit" name= "command" value= "Delete" onclick="return confirm('Are you sure you wish to delete this post?')" >Delete????</button>
          </fieldset>
        </form>
    <?php else: ?>
        <p>No quote selected. <a href="?id=0">Try this link</a>.</p>
    <?php endif ?>
</div>

<!-- <-footer.php starts here--------->
<br /><br />
 <?php  require 'footer.php'; ?>
