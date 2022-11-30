<?php
if (!isset($_SESSION['user_admin']) || !$_SESSION['user_admin'])
{
  header("location:index.php");
  exit;
}
 ?>



		<ul>
			<li><a href="user_control.php">User Control</a></li>
			<li><a href="entry_control.php">Entry Control</a></li>
		</ul>

  <div class="container" style="width:500px;">
       <h4 align="left"><a href="admin_landing.php"> | Welcome to the Admin Zone 🎃| </a></h3>
  </div>
<!-- localhost:31337/WD2/final_skate_wd2_project/admin_landing.php -->
