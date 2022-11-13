<?php
/*
 * Name:Alex Fleming
 * Title: index.php
 * Description: This file has the code related to the home page.
 *
 */

 require 'connect.php';

// ● Query the tweets table for all rows so that the latest tweets appear at the top.
$query="SELECT * FROM blog ORDER BY id DESC LIMIT 5";

// Returns a PDOStatement object.
$statement = $db->prepare($query);

$statement->execute();
$data = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <title>J. Twotwo Blog - General</title>
      <link rel="stylesheet" href="style_index.css" type="text/css">
</head>
<body>
<h1><a href="index.php">J. Twotwo Blog - Index</a></h1>
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="create.php">New Post</a></li>
</ul>

<?php  foreach($data as $row) {  ?>
    <div class="blog_post">
        <h2><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></h2>

        <small>
            <?=date("F d, Y, h:i a",strtotime($row['created_on']))?>
            <a href="edit.php?id=<?=$row['id']?>">edit</a>

        </small>

            <?php if (strlen($row['content']) > 200)
            {
              $link = '<a href="show.php?id=' . $row['id'] . '">Read more</a>';
              echo substr($row['content'], 0, 200) . '...' . $link;
            }
            else
            {
              echo $row['content'];
            }?>


            

  <?php } ?>
<div id="footer">2022 - No Rights</div>
</body>
</html>
