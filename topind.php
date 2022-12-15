
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Personal Use Corporation™  </title>
    <link rel="stylesheet" href="style.css" type="text/css">

    <title> WD2 | Skateboard Tracking System |   Personal Use Corporation </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link class="darklight" href="" />


    <a href="#" class="styleswitch" rel="dark.css">Dark</a> <a href="#" class=" styleswitch " rel="light.css">Light</a>
</head>
  <script type="text/javascript"> $(".styleswitch").click(function() { $('.darklight').attr('href' , $(this).attr('rel')).attr('rel' , 'stylesheet');  }); </script>

  <!-- <body> -->
  <body style="background-color: lightgreen">
  <div class="container" style="width:500px;">
  <h3 align="center"><a href="index.php"> | WD2 | Skateboard Tracking System | </a></h3>
  <h4>  Personal Use Corporation </h4>
  <br />
 </div>

  <div id="wrapper">
  <header id="header_main">


	</header>
	<nav id="menu">
    <br /><br />
		<ul>
			<li><a href="index.php">Home</a></li>

<?php if(isset($_SESSION['user_id'])) { ?>

  <li><a href="create.php">New Post</a></li>
<?php      if($_SESSION['user_admin']==1) { ?>
    <li><a href="user_control.php">User Control</a></li>
    <li><a href="admin_landing.php">Admin Home</a></li>
    <li><a href="sk_api.php">Find a Winnipeg Skatepark</a></li>
<?php      } ?>


  <li><a href="logout.php">Logout (<?=$_SESSION['user_name']?>)</a></li>
<?php } else { ?>

  <li><a href="cap_pop.php">Register</a></li>
  <li><a href="log_reg.php?action=login">Login</a></li>

<?php } ?>
		</ul>
	</nav>
  <div id="content_area">
