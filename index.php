<?php
 require 'connector.php';

 $query="SELECT * FROM final_skate ORDER BY id DESC LIMIT 10";

 // Returns a PDOStatement object.
 $statement = $db->prepare($query);

 $statement->execute();
 $data = $statement->fetchAll();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">

  <!-- Title goes here -->
  <title>Final Project - Personal Use Corporation</title>

  <link rel="stylesheet" href="style_index.css" type="text/css">
</head>
<body>
  <h1><a href="index.php">The Personal Use Corporation ::skateboard component:: *judgment of quality system™*</a></h1>
  <ul id="menu">
      <li><a href="index.php" class='active'>Home</a></li>
      <li><a href="create.php">New Entry</a></li>
  </ul>

  <?php  foreach($data as $row) {  ?>
      <div class="deck_post">
          <h2>Title: <a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></h2>


 <!-- the time stamp for homepage -->
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



    <?php } ?>
  <div id="footer">2022 - Copyright™</div>
  </body>
</html>
