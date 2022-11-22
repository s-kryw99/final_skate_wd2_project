<?php>


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


<!-- in HTML section -->

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
