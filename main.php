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


  <?php  foreach($data as $row) {  ?>
      <div class="deck_post">
<div class="container">
        <fieldset>
          <p>
          <legend><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></legend>

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

              <!-- the time stamp for homepage  -->
                        <small>
                          <?=date_format(date_create($row['datetimestamp']), "F d, o, h:i a")?> -
                          <a href="edit.php?id=<?=$row['id']?>">edit</a>
                        </small>
              <br /><br />
              <br /><br />
            </p>

      </fieldset>
      </div>
    <?php } ?>


<!-- footer.php starts here -->
<br /><br />
 <?php  require 'footer.php'; ?>
