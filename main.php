<?php
 require 'connect.php';
 require 'header.php';


  if(!isset($_SESSION["username"]))
  {
       header("location:main.php?action=login");
  }


 $query="SELECT * FROM final_skate ORDER BY id DESC LIMIT 10";

 // Returns a PDOStatement object.
 $statement = $db->prepare($query);

 $statement->execute();
 $data = $statement->fetchAll();
 ?>


<!-- html header removed here -->
  <!-- added front entry.php -->
      <br /><br />
      <div class="container" style="width:500px;">
           <h3 align="center"><a href="index.php"> WD2 | Skateboard Tracking System | Personal Use Corporation </a></h3>
           <br />
           <?php
           echo '<h1>Welcome - '.$_SESSION["username"].'</h1>';
           echo '<label><a href="main.php">Logout</a></label>';
           ?>
      </div>

<!--
  <ul id="menu">
      <li><a href="index.php" class='active'>Home</a></li>
      <li><a href="create.php">New Entry</a></li>
  </ul> -->



  <?php  foreach($data as $row) {  ?>
      <div class="deck_post">

        <fieldset>
          <legend><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></legend>
          <p>



  <!-- the time stamp for homepage  -->
          <p>
  					<small>
  						<?=date_format(date_create($row['datetimestamp']), "F d, o, h:i a")?> -
  						<a href="edit.php?id=<?=$row['id']?>">edit</a>
  					</small>
  				</p>
          <h4>Brand: <a <?=$row['id']?>> <?=$row['brand']?> </a></h4>

<!-- The notes section with read more option -->
            <h4> Notes:
              <?php if (strlen($row['notes']) > 200)
              {
                $link = '<a href="show.php?id=' . $row['id'] . '">Read more</a>';
                echo substr($row['notes'], 0, 100) . '...' . $link;
              }
              else
              {
                echo $row['notes'];
              }?>
          </h4>
        </p>
      </fieldset>

    <?php } ?>

<br /><br />
 <?php  require 'footer.php'; ?>
