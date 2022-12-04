<?php
require 'connect.php';
require 'header.php';
include('scripts/captcha_form.php');
 ?>



 <div class="container" style="width:500px;">
      <h3 align="center"><a href="index.php"> | WD2 | Skateboard Tracking System | </a></h3>
      <h4 align="center"><a href="index.php">  Personal Use Corporation  </a></h3>
      <br />
 </div>

<div align="center">
<!-- <form method="post" action="log_reg.php"> -->

  <form method="post" action="cap_pop.php">
  <fieldset>
    <legend>You May Login or Register Please</legend>
    <br />      <br />
    <button id= "user" type="submit" name= "commandR" value= "register" >Register🍕</button>
  </fieldset>
</form>


<form method="post" onclick="openForm()" action="log_reg.php?action=login">
  <fieldset>

    <br />      <br />
    <button id= "user" type="submit" name= "commandL" value= "login" >Login🍰</button>
  </fieldset>
</form>


<!-- <-footer.php starts here--------->
<br /><br />
 <?php  require 'footer.php'; ?>
