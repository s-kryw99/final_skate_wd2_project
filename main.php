<?php

require 'header.php';
require 'connect.php';

if ($_POST['order'] == "ASC")
   // echo "yes";
    //else
   // echo "no";

 $order = "ASC";
 else  $order = "DESC";

if ($_POST['taskOption'] == "title")
// echo "yes ";
//  else
// echo "no ";
$cata = "title";


elseif ($_POST['taskOption'] == "brand")
$cata = "brand";

else $cata = "datetimestamp";
// var_dump($cata);
// var_dump($_POST);


$query="SELECT * FROM final_skate ORDER BY " . $cata . " " . $order . " LIMIT 10 ";
		$statement = $db->prepare($query);


		$statement->execute();

		if($statement->rowCount() <= 0)
		{
			header("Location: index.php");
			exit;
		}
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
            <link rel="stylesheet" href="styles.css" type="text/css">
    	<script src="button.js"></script>
  </head>
  <body>

     <?php while ($row = $statement->fetch()) : ?>
     <div>
       <div class="container">
     <fieldset>
       <p>
            <?php if (strlen($row['notes']) > 200) :
             $link = '<a href="show.php?id=' . $row['id'] . '"></a>';
            ?>

          <legend><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></legend>
      <!--
            order is desc or make
                   conditona put if around it
                   name sort value sort desc -->

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
    <!-- <button id= "sort" name= "order" value= "yes" >Sort Catagory</button> -->

</form>

  </body>
</html>
