<?php
 // require 'connect.php';
 // require 'header.php';



$cata = "datetimestamp";
$order = "ASC";

if ($_POST)
{
  if ($_POST['order'] == "ASC")
   $order = "ASC";
  else
   $order = "DESC";


  if ($_POST['sort_select'] == "title")
  $cata = "title";

  elseif ($_POST['sort_select'] == "brand")
  $cata = "brand";
}

// <------------------sort code over--------------------------------------------------->
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
<!---list sorter html starts here------------------------------------------------------->
    <form method = post>
<?php if ($order == "DESC") : ?>
    <button id= "sort" name= "order" value= "ASC" >Sort Catagory⏫</button>
    <?php else : ?>
    <button id= "sort" name= "order" value= "DESC" >Sort Catagory⏬</button>
    <?php endif ?>

    <select name="sort_select" id="sort_select">
      <option value="title">Title</option>
      <option value="brand">Brand</option>
      <option selected value="datetimestamp">Date</option>
    </select>

    <script type="text/javascript">
  document.getElementById('sort_select').value = "<?php echo $_POST['sort_select'];?>";
</script>

</form>
<br /><br />

  <?php
  /*if(isset($_SESSION['user_id']))
  {
    echo $_SESSION['status_valid'];
    unset($_SESSION['status_valid']);
  }*/
  ?>


  <?php  foreach($data as $row) {  ?>
      <div class="deck_post">
<div class="container">
        <fieldset>
          <p>
          <legend><a hidden=<?=$row['id']?>"><?=$row['title']?></a></legend>
          <a><?=$row['title']?></a>
          <h4>Brand: <a <?=$row['id']?>> <?=$row['brand']?> </a></h4>
<!-- The notes section with read more option -->
            <h5> Notes:
              <?php if (strlen($row['notes']) > 500)
              {
                // $link = '<a href="show.php?id=' . $row['id'] . '">Read more</a>';
                echo substr($row['notes'], 0, 500) . '...' . $link;
              }
              else
              {
                echo $row['notes'];
              }?>
            </h4>
              <!-- the time stamp for homepage  -->
                        <small>
                          <?=date_format(date_create($row['datetimestamp']), "F d, o, h:i a")?>

                        </small>
              <br /><br />
              <br /><br />
            </p>
      </fieldset>
      </div>
    <?php } ?>
