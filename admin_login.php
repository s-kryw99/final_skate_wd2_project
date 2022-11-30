<?php
require 'connect.php';
require 'header.php';

// if($_POST["password"] == $_POST["repassword"])
// {
//   echo 'yes they match';
// }
// else
// {
//   echo '<script>alert("Ваші паролі не збігаються.")</script>';
// }


if(isset($_SESSION["username"]))
{
     header("location:main.php");
}
if(isset($_POST["register"]))
{
     if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["repassword"]))
     {
          echo '<script>alert("All Fields are required")</script>';
     }
     elseif ($_POST["password"] == $_POST["repassword"])
     {
          $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
          $password  = password_hash($password, PASSWORD_DEFAULT);
          $user_id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

          $query     = "INSERT INTO users (user_name, user_pass, user_email, user_id) values (:user_name, :user_pass, :user_email, :user_id)";

            $statement = $db->prepare($query);
            $statement->bindValue(':user_name', $username); //search and replace, searches for tag , replaces with value.
            $statement->bindValue(':user_pass', $password);
            $statement->bindValue(':user_email', $email);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();

            // Determine the primary key of the inserted row.
            $insert_id = $db->lastInsertId();

                echo 'yes they match';
                echo '<script>alert("Registration Done")</script>';
                // header("location:index.php?action=login");
          }
          else
          {
              echo '<script>alert("Ваші паролі не збігаються.")</script>';
          }
     }


     if(isset($_POST["login"]))
     {
          if(empty($_POST["username"]) || empty($_POST["password"]))
          {
              echo '<script>alert("Both Fields are required")</script>';
        }
        else
        {
             $username   = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $password   = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $user_admin = filter_input(INPUT_POST, 'user_admin', FILTER_SANITIZE_NUMBER_INT);

             $query     = "SELECT * FROM users WHERE user_name = :user_name AND user_name = :user_name";


             $statement = $db->prepare($query);
             $statement->bindValue(':user_name', $username);
             $statement->bindValue(':user_admin', $user_admin);
             $statement->execute();
             $row=$statement->fetch();

             if (password_verify($password, $row['user_pass']) && $row['user_admin'])
             {

                 $_SESSION['user_admin'] = $row['user_admin'];

                 $_SESSION['status_valid'] = "Password is Valid";
                 header("location:admin_landing.php");
                 exit;
               }
             else
             {
                 echo '<script>alert("Invalid password.")</script>';
             }
           }
      }
?>

<!-- <-header.php starts here------------>
<div class="container" style="width:500px;">
     <h3 align="center"><a href="admin_login.php?action=login"> | WD2 | Skateboard Tracking System | </a></h3>
     <h4 align="center"><a href="admin_login.php?action=login">  Personal Use Corporation  </a></h3>
     <br />
       </div>
          <div class="container" style="width:500px;">
               <h3 align="center">Login Registration Form</h3>
               <h4 align="center">Skateboard Tracking System</h4>
               <br />
<?php
if(isset($_GET["action"]) == "login")
{
?>
               <h3 align="center">Login</h3>
               <br />
               <form method="post">
                    <label>Enter Username</label>
                    <input type="text" name="username" class="form-control" />
                    <br />
                    <label>Enter Password</label>
                    <input type="password" name="password" class="form-control" />
                    <br />
                    <input type="submit" name="login" value="Login" class="btn btn-info" />
                    <br />
                    <p align="center"><a href="index.php"></a></p>
               </form>
<?php
}
else
{
?>
               <h3 align="center">Register</h3>
               <br />
               <form method="post">
                    <label>Enter Username</label>
                    <input type="text" name="username" class="form-control" />
                    <br />
                    <label>Enter Password</label>
                    <input type="password" name="password" class="form-control" />
                    <br />
                    <label>Re-enter Password</label>
                    <input type="repassword" name="repassword" class="form-control" />
                    <br />
                    <label>Enter Email</label>
                    <input type="email" name="email" class="form-control" />
                    <br />
                    <input type="submit" name="register" value="Register" class="btn btn-info" />
                    <br />
                    <p align="center"><a href="index.php?action=login">Login</a></p>
               </form>
<?php
}
?>
            </div>
        </body>
     </html>


<!-- footer.php starts here -->
<?php require 'footer.php';?>
