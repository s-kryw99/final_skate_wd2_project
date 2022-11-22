<?php
/* Assignment:	Final
 * Programmer:	Alex Fleming
 * Title:	Final Assignment
 * Description:	PHP Script for processing edits to blog posts, whether it's an edit or a deletion,
					with validation for whether the title or main content field have data.
 * Date:
 */

	require('connect.php');

	$edit_failure = false;

	if (!empty($_POST['command']) && $_POST['command'] == 'Update')
	{
		if ($_POST && !empty($_POST['title']) && !empty($_POST['notes']) && !empty($_POST['id']) && !empty($_POST['year_used'])
    && !empty($_POST['release_year']) && !empty($_POST['width']) && !empty($_POST['length']) && !empty($_POST['brand'])
    && !empty($_POST['rating']))
		{
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $brand  = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $length       = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);
      $width        = filter_input(INPUT_POST, 'width', FILTER_SANITIZE_NUMBER_INT);

      $release_year = filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_NUMBER_INT);
      $year_used  = filter_input(INPUT_POST, 'year_used', FILTER_SANITIZE_NUMBER_INT);


			$query = "UPDATE final_skate SET title = :title, notes = :notes, brand = :brand, rating = :rating, length = :length, width = :width, release_year = :release_year, year_used = :year_used WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':title', $title);
			$statement->bindValue(':notes', $notes);

      $statement->bindValue(':brand', $brand);
      $statement->bindValue(':rating', $rating);

      $statement->bindValue(':length', $length);
      $statement->bindValue(':width', $width);

      $statement->bindValue(':release_year', $release_year);
      $statement->bindValue(':year_used', $year_used);

			$statement->bindValue(':id', $id, PDO::PARAM_INT);

			$statement->execute();

			header("Location: show.php?id={$id}");
			exit;
		}
		else if (!empty($_GET['id']))
		{
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

			$query = "SELECT * FROM final_skate WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);

			$statement->execute();
			$row = $statement->fetch();
		}
		else
		{
			$id = false;
			$edit_failure = true;
		}
	}
	else if ($_POST['command'] == 'Delete')
	{
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

		$query = "DELETE FROM final_skate WHERE id = :id LIMIT 1";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);

		$statement->execute();

		header("Location: index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Post Error</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div id="wrapper">
<?php if($edit_failure) : ?>
		<h1>An error occured while processing your post.</h1>
		<p>Both the title and content must contain at least one character. </p>
		<a href="index.php">Return Home</a>
<?php endif ?>


			<!-- Footer inserted here -->
		<br /><br />
		<?php  require 'footer.php'; ?>
