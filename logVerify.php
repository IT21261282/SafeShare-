<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style1.css">
    <title>Login</title>
</head>
<body>

<div class="title1">
  SafeShare - Privacy Preserving File Sharing Platform
</div>
      <div class="container1">
        <div class="box form-box">
           
            <header>Verify LogIn</header>
            <form action="php/logVerify.inc.php" method="post">
                <div class="field input">
                    <label for="empId">Please enter the OTP that has been sent to your email: </label>
                    <input type="int" name="otp" id="otp" autocomplete="off" required>
                </div>

                <div class="field">                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>

            </form>

            <?php
              if(isset($_GET["error"])){
                if($_GET["error"] == "OTPWRG"){
                  echo "<script>alert('OTP is incorrect!!');</script>";
                }
                else if($_GET["error"] == "emptyinput"){
                  echo "<script>alert('Fill the blank!!');</script>";
                }
              }
            ?>
            
        </div>
      
      </div>
</body>
</html>