<?php
/*
 * Name:Alex Fleming
 * Title: show.php
 * Description: This file has the code related to clicking the title of a blog post or "read more" links.
 *
 */

require('connector.php');
$id = $_GET['id'];

$query = "SELECT * FROM final_skate WHERE id=:id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

// Execute the SELECT and fetch the single row returned.
$statement->execute();
$skate_or_die = $statement->fetchAll();
// var_dump($skate_or_die);

 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="style.css" type="text/css">
 </head>
 <body>
   <div id="wrapper">
     <div id="header">
     </div>
     <ul id="menu">
       <li><a href="index.php">Home</a></li>
       <li><a href="create.php">New Post</a></li>
     </ul>
     <div id="all_decks">
       <div class="deck_post">
         <p>
           <small>
   <!-- //date -->
 <?=date("F d, Y, h:i a",strtotime($skate_or_die[0]['date']))?>
 <!-- edit page link -->
 <a href="edit.php?id=<?=$skate_or_die[0]['id']?>">edit</a>
</small>
</p>
<h1><?=$skate_or_die[0]['title'] ?></h1>
<h5><?=$skate_or_die[0]['brand'] ?></h5>
<h5><?=$skate_or_die[0]['rating'] ?></h5>

<h5><?=$skate_or_die[0]['length'] ?></h5>
<h5><?=$skate_or_die[0]['width'] ?></h5>

<h6><?=$skate_or_die[0]['release_year'] ?></h6>
<h6><?=$skate_or_die[0]['year_used'] ?></h6>

<h2><?=$skate_or_die[0]['notes']?></h2>
</div>
</div>
<div id="footer">
  Copywrong 2022 - No Rights Reserved
</div>
</div>
</body>
</html>
