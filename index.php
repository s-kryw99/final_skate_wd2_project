<?php
require 'connect.php';


if(isset($_SESSION["username"]))
{
     header("location:main.php");
}
if(isset($_POST["register"]))
{
     if(empty($_POST["username"]) && empty($_POST["password"]) || ($_POST["username"]) && empty($_POST["password"]) || empty($_POST["username"]) && ($_POST["password"]))
     {
          echo '<script>alert("Both Fields are required")</script>';
     }
     else
     {
          // $username = mysqli_real_escape_string($connect, $_POST["username"]);
          // $password = mysqli_real_escape_string($connect, $_POST["password"]);

          $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
          $password  = md5($password);
          $user_id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);


          $query     = "INSERT INTO users (user_name, user_pass, user_email, user_id) values (:user_name, :user_pass, :user_email, :user_id)";

            $statement = $db->prepare($query);
            $statement->bindValue(':user_name', $username);
            $statement->bindValue(':user_pass', $password);
            $statement->bindValue(':user_email', $email);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();

            // Determine the primary key of the inserted row.
            $insert_id = $db->lastInsertId();

          {
 // var_dump($password);
                echo '<script>alert("Registration Done")</script>';
                     // header("location:index.php?action=register");
          }


        }
     }


     if(isset($_POST["login"]))
     {
          if(empty($_POST["username"]) && empty($_POST["password"]) || ($_POST["username"]) && empty($_POST["password"]) || empty($_POST["username"]) && ($_POST["password"]))
          {
              echo '<script>alert("Both Fields are required")</script>';
        }
        else
        {
             $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $password  = md5($password);
             $user_id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

             $query   = "SELECT * FROM users WHERE user_name = $username AND user_pass = $password AND user_id = $user_id";


             $hash = password_hash('password', PASSWORD_DEFAULT);

             var_dump($hash);
             var_dump($password);
             var_dump($_POST['password']);

             if (password_verify('password', $hash)) {
                 echo 'Password is valid!';
             } else {
                 echo 'Invalid password.';
             }


             if($hash == true)
             // if('password' == $hash)
             {
               echo "yes";
               header("location:main.php");
               exit;
             }
             else
             {
               exit;
              }
           }
      }
?>

            <!-- // $query     = "SELECT * FROM users WHERE user_name = $_POST['username'] AND user_pass = $_POST['password']";
            // $query     = "INSERT INTO users (user_name, user_pass, user_id) values (:user_name, :user_pass, :user_id)";

            // $query   = "SELECT * FROM users WHERE user_name = $username AND user_pass = $password AND user_id = $user_id";

            // $query   = "SELECT * FROM users WHERE user_name = $_POST['username'] AND user_pass = $_POST['password'] AND user_id";
            // "SELECT user_id, user_name, user_admin FROM users WHERE user_email='bvincelette@rrc.ca' AND user_pass=$_POST['user_pass'] AND active=1";
//
//             $query = "SELECT (user_name, user_pass, user_id) values (:user_name, :user_pass, :user_id) FROM users WHERE user_name = 'username' AND user_pass = 'password' AND user_id = 'id'";
//
// var_dump($_POST['username']);
// var_dump($_POST['password']);
//
//             $statement = $db->prepare($query);
//             $statement->bindValue(':user_name', $username);
//             $statement->bindValue(':user_pass', $password);
//             $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
//         		$statement->execute();
//
// var_dump($statement->rowCount());
// // var_dump($data);
//
//
//               if($statement->rowCount() > 0)
//             {
//               echo "yes";
//
//
//                  header("location:main.php");
//                  exit;
//             }
//
//             else
//             {
//
//                  // exit;
//             } -->


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
