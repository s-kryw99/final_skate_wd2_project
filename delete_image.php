<?php
/* Assignment:	3
 * Programmer: Alex Fleming
 * Title:	Final Assignment
 * Description:	PHP
 * Date:
 */

 require 'header.php';

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $sp_image = filter_input(INPUT_POST, 'sp_image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $commandX = filter_input(INPUT_POST, 'commandX', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if(!$id)
{
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
}



	if (!$id || $id <= 0)
	{
			// header("Location: show.php");
      header("Location: main.php");
			exit;
	}
		$query = "SELECT * FROM final_skate WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);

		$statement->execute();

		if($statement->rowCount() <= 0)
		{
			// header("Location: show.php");
      header("Location: main.php");
			exit;
		}

		$row = $statement->fetch();
?>



  <?php

    if($commandX == 'Delete Image')
        {
        $query = "UPDATE final_skate SET sp_image = NULL WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // header("Location: show.php");
        header("Location: main.php");
        exit;
        }
?>


      <!-- show.php?id={$id} -->
      <fieldset>
    <?php
    if(isset($row['sp_image']))
    	{
        	 echo '<p><img alt="Image not found" width="200" height="200" src= "uploads/'. $row['sp_image'] . '" onerror="this.remove()" ></p>';
    	}
      else
      {
        echo '🧙‍';

        }
    ?>

<!-- delete image html form  and button -->
<?php if(!isset($row['sp_image']))
{?>
        <p> You Have No Uploaded Images </p>
<?php }
else { ?>

  <form action="edit.php?id=<?=$row['id']?>" method="post">
    <fieldset>
      <legend></legend>
      <p>

        <input type="hidden" name="sp_image" id="sp_image" value="<?=$row['sp_image']?>">
      </p>
      <p>
        <input type="hidden" name="id" value="<?=$row['id']?>">
        <input type="submit" name="commandX" value="Delete Image" onclick="return confirm('Are you sure you wish to delete this image?')">
      </p>
    </fieldset>
  </form>

<?php } ?>


      <!-- <input type="checkbox" name="pic_check" value="1"> -->
