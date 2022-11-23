<?php
 require 'connect.php';
 require 'header.php';
 require 'home_create_menu.php';
 require 'exit_page.php';
  // if(!isset($_SESSION["username"]))
  // {
  //      header("location:main.php?action=login");
  // }

  if ($_POST['order'] == "ASC")
   $order = "ASC";
   else  $order = "DESC";

  if ($_POST['taskOption'] == "title")
  $cata = "title";

  elseif ($_POST['taskOption'] == "brand")
  $cata = "brand";

  else $cata = "datetimestamp";


  // $query="SELECT * FROM final_skate ORDER BY " . $cata . " " . $order . " LIMIT 10 ";
  		// $statement = $db->prepare($query);
  		// $statement->execute();


  		// if($statement->rowCount() <= 0)
  		// {
  		// 	header("Location: main.php");
  		// 	exit;
  		// }

// <------------------sort code over--------------------------------------------------->
 // $query="SELECT * FROM final_skate ORDER BY id DESC LIMIT 10";
 $query="SELECT * FROM final_skate ORDER BY " . $cata . " " . $order . " LIMIT 10 ";
 // Returns a PDOStatement object.
 $statement = $db->prepare($query);
 $statement->execute();
 $data = $statement->fetchAll();

 if($statement->rowCount() <= 0)
  {
  	header("Location: main.php");
  	exit;
  }


 ?>



<!-- html header starts here -->


  <?php

  if(isset($_SESSION['status_valid']))
  {
    echo $_SESSION['status_valid'];
    unset($_SESSION['status_valid']);
  }


  ?>


  <?php  foreach($data as $row) {  ?>
      <div class="deck_post">
<div class="container">
        <fieldset>
          <p>
          <legend><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></legend>

          <h4>Brand: <a <?=$row['id']?>> <?=$row['brand']?> </a></h4>
<!-- The notes section with read more option -->
            <h5> Notes:
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

<!---list sorter html starts here------------------------------------------------------->
    <form method = post>
<?php if ($order == "DESC") : ?>
    <button id= "sort" name= "order" value= "ASC" >Sort Catagory ⏫</button>
    <?php else : ?>
    <button id= "sort" name= "order" value= "DESC" >Sort Catagory⏬</button>
    <?php endif ?>

    <select name="taskOption">
      <option value="title">Title</option>
      <option value="brand">Brand</option>
      <option value="datetimestamp">Date</option>
    </select>
</form>


<!-- footer.php starts here -->
<br /><br />
 <?php  require 'footer.php'; ?>
