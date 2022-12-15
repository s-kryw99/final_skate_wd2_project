 <?php
 require 'connect.php';
 require 'header.php';

 $id   = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
 $query     = "SELECT * FROM users";

 $statement = $db->prepare($query);
 $statement->execute();
 $rows=$statement->fetchall();
 ?>

 <!-- html header starts here -->
 <form method="submit" action="admin_create_user.php">
   <fieldset>
     <legend>User Control</legend>
 <button id= "user" type="submit" name= "command" value= "Update" >Create User🤖</button>
 <br />      <br />
</fieldset>
</form>

   <div class="container" style="width:500px;">
 <?php foreach($rows as $row): ?>

<p><?= $row['user_name'];?>
  <br />

<small>
  <a href="user_edit.php?id=<?=$row['id']?>">edit</a>
</small>
   <?php endforeach ?>
    </p>
</div>

 <!-- footer.php starts here -->
 <br /><br />
  <?php  require 'footer.php'; ?>
