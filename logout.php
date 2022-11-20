<?php
/*
**
**
**
*/
// brads logout code below


// session_destroy();
// header("Location: index.php");
//


//logout.php
session_start();
session_destroy();
header("location:index.php?action=login");
?>
