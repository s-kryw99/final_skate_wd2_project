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
		if ($_POST && !empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['id']) && !empty($_POST['user_pass']))
		{
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			$user_pass = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $user_email  = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


			$query = "UPDATE users SET user_pass = :user_pass, user_name = :user_name, user_email = :user_email WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_pass', $user_pass);
			$statement->bindValue(':user_name', $user_name);
      $statement->bindValue(':user_email', $user_email);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);

			$statement->execute();

			header("Location: admin_show_user.php?id={$id}");
			exit;
		}
		else if (!empty($_GET['id']))
		{
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

			$query = "SELECT * FROM users WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);

			$statement->execute();
			$row = $statement->fetch();
		}
		else
		{
			$id = false;
      // *****
			$edit_failure = true;
		}
	}
	else if ($_POST['command'] == 'Delete')
	{
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

		$query = "DELETE FROM users WHERE id = :id LIMIT 1";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);

		$statement->execute();

		header("Location: admin_landing.php");
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
		<a href="admin_landing.php">Return Home</a>
<?php endif ?>


			<!-- Footer inserted here -->
		<br /><br />
		<?php  require 'footer.php'; ?>
