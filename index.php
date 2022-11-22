<?php
require 'connect.php';
require 'header.php';

if(isset($_SESSION["username"]))
{
     header("location:main.php");
}
if(isset($_POST["register"]))
{
     if(empty($_POST["username"]) || empty($_POST["password"]))
     {
          echo '<script>alert("Both Fields are required")</script>';
     }
     else
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
          {
                echo '<script>alert("Registration Done")</script>';
                     // header("location:index.php?action=login");
          }
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
             $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             // $user_id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

             $query     = "SELECT * FROM users WHERE user_name = :user_name";

             $statement = $db->prepare($query);
             $statement->bindValue(':user_name', $username);
             $statement->execute();
             $row=$statement->fetch();

//  echo $password;
// echo '<br>';
//  echo $username;
//  echo '<br>';
// // var_dump(password_verify($row['user_pass'], $password));
// echo '<br>';
// var_dump(password_verify($password, $row['user_pass']));
// echo '<br>';
// var_dump($row['user_pass']);
// echo '<br>';


             if (password_verify($password, $row['user_pass']))
             {
                  // echo '<script>alert("Password is valid!")</script>';
                  $_SESSION['status_valid'] = "Password is Valid";
                 header("location:main.php");
                 exit;
               }
             else
             {
                 echo '<script>alert("Invalid password.")</script>';
                 // $_SESSION(echo 'Access Granted');
             }
//putmessage into seession var and then go to main.
// then on main you have something there that says is that session variable set? if so display the message.
// afterdisplay message . then unset that varible.

             // if($password)
             // // if('password' == $hash)
             // {
             //   echo "yes";
             // }
             // else
             // {
             //   exit;
             //  }
           }
      }
?>


<!DOCTYPE html>
<html>
     <head>
          <title>WD2 | Skateboard Tracking System | Personal Use Corporation </title>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     </head>
     <body>
          <br /><br />
          <div class="container" style="width:500px;">
               <h3 align="center">PHP Login Registration Form with md5() Password Encryption</h3>
               <h3 align="center"> WD2 | Skateboard Tracking System   Personal Use Corporation</h3>
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
                    <p align="center"><a href="index.php">Register</a></p>
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
