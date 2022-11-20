<?php 
/*
** Name:
** File/Function:
** Description:
**               
*/
require_once('connect.php'); # put the session_start();

$page_hdr='Domain/Site Name';
$page_h1='Post or Page Name';
$page_serp= $page_h1.' - Section - '.$page_hdr;
require_once('header.php');






if(!isset($_GET['id']) && !isset($_POST['id'])) {
	
	
	echo 'list records or customers or posts, SQL to put into array...<br><br>';
	
	
	
} else if(isset($_GET['id'])) {

	
	echo "edit record or customer form or view blog post<br /><br />";


} else if(isset($_POST['id'])) {
	
	
	#echo $_SESSION['user_id']
	
	echo "saving data<br><br>";
	echo "<pre>"; print_r($_POST); echo "</pre>";
	
	header("Location: index.php");
	
}

																								// ------------------------------------------------------------------
																								#$query = "SELECT * FROM posts ORDER BY time DESC LIMIT 5";
																								#$statement = $db->prepare($query);
																								#$statement->execute();

// content ---------------------------------------------------------- ?>


<?php if(!isset($_GET['id']) && !isset($_POST['id'])) { ?>


<div>Listing of Customers (LOOP)</div><br /><br />
<div><a href="?id=1">Edit</a> | Customer Name | Address</div><br /><br />


	
<?php } elseif(isset($_GET['id'])) { ?>
	
<form method="POST" action="index.php">
	


	<input type="hidden" name="id" value="<?=$_GET['id']?>">
	<input type="submit" value="Submit">
</form>
	
	
<?php } elseif(isset($_POST['id'])) { ?>


<div>Successful</div>


<?php } ?>




<?php
// footer ----------------------------------------------------------- 
require_once('footer.php');
