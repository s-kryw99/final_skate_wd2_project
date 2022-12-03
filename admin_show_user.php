<?php
/*
 * Name:Alex Fleming
 * Title: show.php
 * Description: This file has the code related to clicking the title of a blog post or "read more" links.
 *
 */

require 'connect.php';
require 'header.php';
require 'home_create_menu.php';
require 'exit_page.php';

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

// Execute the SELECT and fetch the single row returned.
$statement->execute();
$user_die = $statement->fetchAll();
?>

<!-- header inserted here -->
<div class="container" style="width:500px;">
     <h3 align="center"><a href="main.php"> | WD2 | Skateboard Tracking System | </a></h3>
     <h4 align="center"><a href="main.php">  Personal Use Corporation  </a></h3>
     <br />
</div>

<!-- //date -->
 <small>


    <a href="user_edit.php?id=<?=$user_die[0]['id']?>">edit</a>
  </small>
</p>
<h2>password:  <?=$user_die[0]['user_pass'] ?></h2>
<h2>username:  <?=$user_die[0]['user_name'] ?></h2>
<h5>email:  <?=$user_die[0]['user_email'] ?></h5>

</div>
</div>



<!-- Footer inserted here -->
<br /><br />
<?php  require 'footer.php'; ?>
