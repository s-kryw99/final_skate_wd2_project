<?php
require 'connect.php';
require 'header.php';
include('scripts/captcha_form.php');

//




  if($_POST['captcha'])
  {
     header("location:log_reg.php");
   }
?>

<!-- <-header.php starts here------------>
   <div class="container" style="width:500px;">
        <h3 align="center"><a href="index.php"> | WD2 | Skateboard Tracking System | </a></h3>
        <h4 align="center"><a href="index.php">  Personal Use Corporation  </a></h3>
        <br />
   </div>
          <div class="container" style="width:500px;">
               <br />
               <h3 align="center">Please, Complete the Captcha to Advance</h3>
               <br />
               <form method="post">

                      <!-- CAPTCH form -->
                    <div class="row">
                      <div class="form-group col-6">
                        <label>Enter Captcha</label>
                        <input type="text" class="form-control" name="captcha" id="captcha">
                      </div>
                      <div class="form-group col-6">
                        <label>Captcha Code</label>
                        <img src="scripts/captcha.php" alt="PHP Captcha">
                      </div>
                    </div>
                    <br />

                    <div class="container mt-5">
                      <!-- Captcha error message -->
                      <?php if(!empty($captchaError)) {?>
                        <div class="form-group col-12 text-center">
                          <div class="alert text-center <?php echo $captchaError['status']; ?>">
                            <?php echo $captchaError['message']; ?>
                          </div>
                        </div>
                      <?php }?>

                      <div class="container" align="center" style="width:300px;">
                       <form action="" name="register" method="post" enctype="multipart/form-data">
                        <input type="submit" name="send" value="Send" class="btn btn-dark btn-block">
                      </form>
                    </div>
               </form>
            </div>
            </div>
        </body>
     </html>


<!-- footer.php starts here -->
<?php require 'footer.php';?>
