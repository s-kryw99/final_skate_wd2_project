<?php
 require 'connect.php';
 require 'exit_page.php';
 require 'header.php';
 require 'home_create_menu.php';
 require 'admin_header.php';

 $id   = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

 $query     = "SELECT * FROM users";

 $statement = $db->prepare($query);
 // $statement->bindValue(':id', $id, PDO::PARAM_INT);
 $statement->execute();
 $rows=$statement->fetchall();


//<a href="?id=<?= $row['id'];
// put closing php here    "> Words </a>
 ?>

 <!-- html header starts here -->
 <div class="container" style="width:500px;">
      <h4 align="center"><a href="admin_landing.php">  Personal Use Corporation  </a></h3>
 </div>


 <form method="post" action="admin_create_user.php">
   <fieldset>
     <legend>User Control</legend>
 <button id= "user" type="submit" name= "command" value= "Update" >Create User🤖</button>
 <br />      <br />
</fieldset>
</form>


   <div class="container" style="width:500px;">
 <?php foreach($rows as $row): ?>

   <!-- echos php and open php-->
<p><?= $row['user_name'];?>
  <br />

<small>
  <a href="user_edit.php?id=<?=$row['id']?>">edit</a>
</small>

   <?php endforeach ?>
    </p>
</div>

   <!-- click button for edit, delete and update. -->

 <!-- footer.php starts here -->
 <br /><br />
  <?php  require 'footer.php'; ?>
