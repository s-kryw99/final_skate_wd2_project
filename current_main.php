<?php

require 'header.php';
require 'connect.php';

if ($_POST['order'] == "ASC")

 $order = "ASC";
 else  $order = "DESC";

if ($_POST['taskOption'] == "title")

$cata = "title";

elseif ($_POST['taskOption'] == "brand")
$cata = "brand";

else $cata = "datetimestamp";


$query="SELECT * FROM final_skate ORDER BY " . $cata . " " . $order . " LIMIT 10 ";
		$statement = $db->prepare($query);
		$statement->execute();

		if($statement->rowCount() <= 0)
		{
			header("Location: index.php");
			exit;
		}
    ?>


<!-- -header.php starts here- -->

     <?php while ($row = $statement->fetch()) : ?>
     <div>
       <div class="container">
     <fieldset>
       <p>
            <?php if (strlen($row['notes']) > 200) :
             $link = '<a href="show.php?id=' . $row['id'] . '"></a>';
            ?>
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

<!-- date and time -->
          <small>
<?=date_format(date_create($row['datetimestamp']), "F d, o, h:i a")?> -
            <a href="edit.php?id=<?=$row['id']?>">edit</a>
          </small>
          <br /><br />
              <br /><br />

<?php endif ?>
           </div>
<?php endwhile ?>
         </p>
       </fieldset>
       </div>

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
  </body>
</html>
