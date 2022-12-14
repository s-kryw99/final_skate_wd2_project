<?php
require 'connect.php';
require 'header.php';



if(isset($_POST["register"]))
{
     if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]))
     {
          echo '<script>alert("All Fields are Required")</script>';
     }
     elseif ($_POST["password"])
     {
          $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
          $password  = password_hash($password, PASSWORD_DEFAULT);
          $id        = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

          $query     = "INSERT INTO users (user_name, user_pass, user_email, id) values (:user_name, :user_pass, :user_email, :id)";

            $statement = $db->prepare($query);
            $statement->bindValue(':user_name', $username); //search and replace, searches for tag , replaces with value.
            $statement->bindValue(':user_pass', $password);
            $statement->bindValue(':user_email', $email);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            // Determine the primary key of the inserted row.
            $insert_id = $db->lastInsertId();

                echo 'New User Created';
                echo '<script>alert("User Creation Complete")</script>';
                header("location: user_control.php");
          }
          else
          {
              echo '<script>alert("Ваші паролі не збігаються.")</script>';
          }
     }
?>


<!-- <-header.php starts here------------>
          <div class="container" style="width:500px;">
               <h3 align="center">Create User</h3>
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

                      </form>
                    </div>
               </form>
            </div>
        </body>
     </html>


<!-- footer.php starts here -->
<?php require 'footer.php';?>
