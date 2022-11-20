<?php
/* Assignment:	3
 * Programmer: Alex Fleming
 * Title:	Final Assignment
 * Description:	PHP Script for the creation page of blog posts, requiring connecting to the
					database with validation for the user being a registered user.
 * Date:
 */



 require 'connect.php';
 require 'header.php';

	if (!empty($_GET['id']))
	{
		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

		if(!($id > 0))
		{
			header("Location: index.php");
			exit;
		}

		$query = "SELECT * FROM final_skate WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);

		$statement->execute();

		if($statement->rowCount() <= 0)
		{
			header("Location: index.php");
			exit;
		}

		$row = $statement->fetch();
	}
	else
	{
			header("Location: index.php");
			exit;
	}

?>


<!-- header.php starts here -->

		<div id="all_entries">
			<form action="process_edit.php" method="post">
				<fieldset>
					<legend>Edit Post</legend>
					<p>
						<label for="title">Title</label>
						<input name="title" id="title" value="<?=$row['title']?>">
					</p>
          <p>
            <label for="rating">Rating</label>
            <input name="rating" id="rating" value="<?=$row['rating']?>">
          </p>
          <p>
            <label for="brand">Brand</label>
            <input name="brand" id="brand" value="<?=$row['brand']?>">
          </p>
          <p>
            <label for="length">Length</label>
            <input name="length" id="length" value="<?=$row['length']?>">
          </p>
          <p>
            <label for="width">Width</label>
            <input name="width" id="width" value="<?=$row['width']?>">
          </p>
          <p>
            <label for="release_year">Release Year</label>
            <input name="release_year" id="release_year" value="<?=$row['release_year']?>">
          </p>
          <p>
            <label for="year_used">Year Used</label>
            <input name="year_used" id="year_used" value="<?=$row['year_used']?>">
          </p>
					<p>
						<label for="notes">Notes</label>
						<textarea name="notes" id="notes"><?=$row['notes']?></textarea>
					</p>
					<p>
						<input type="hidden" name="id" value="<?=$row['id']?>">
						<input type="submit" name="command" value="Update">
						<input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')">
					</p>
				</fieldset>
			</form>
		</div>

		<!-- Footer inserted here -->
		<br /><br />
		<?php  require 'footer.php'; ?>
