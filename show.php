<?php
/*
 * Name:Alex Fleming
 * Title: show.php
 * Description: This file has the code related to clicking the title of a blog post or "read more" links.
 *
 */

require('connect.php');
$id = $_GET['id'];

$query = "SELECT * FROM blog WHERE id=:id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
// Execute the SELECT and fetch the single row returned.
$statement->execute();
$blog = $statement->fetchAll();
// var_dump($blog);
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
     <div id="all_blogs">
       <div class="blog_post">
         <p>
           <small>
   <!-- //date -->
 <?=date("F d, Y, h:i a",strtotime($blog[0]['created_on']))?>
 <!-- edit page link -->
 <a href="edit.php?id=<?=$blog[0]['id']?>">edit</a>
</small>
</p>
<h1><?=$blog[0]['title'] ?></h1>
<h3><?=$blog[0]['content']?>
</div>
</div>
<div id="footer">
  Copywrong 2022 - No Rights Reserved
</div>
</div>
</body>
</html>
