<?php
 require 'connect.php';
 require 'exit_page.php';
 require 'header.php';
 require 'home_create_menu.php';
 require 'admin_header.php';

 $user_id   = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

 $query     = "SELECT * FROM users";

 $statement = $db->prepare($query);
 // $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
 $statement->execute();
 $rows=$statement->fetchall();


//<a href="?id=<?= $row['user_id'];
// put closing php here    "> Words </a>
 ?>

 <!-- html header starts here -->
 <div class="container" style="width:500px;">
      <h3 align="center"><a href="admin_landing.php"> | WD2 | Skateboard Tracking System | </a></h3>
      <h4 align="center"><a href="admin_landing.php">  Personal Use Corporation  </a></h3>
      <br />
 </div>

   <div class="container" style="width:500px;">
 <?php foreach($rows as $row): ?>

   <!-- echos php and open php-->
<p><?= $row['user_name'];?>
  <br />

<a href="?id=<?= $row['user_id'];?>"> Words </a>
   <?php endforeach ?>

    </p>
</div>

   <!-- click button for edit, delete and update. -->
















 <!-- footer.php starts here -->
 <br /><br />
  <?php  require 'footer.php'; ?>
