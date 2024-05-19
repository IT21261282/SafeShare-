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
    <title>Log-in</title>
</head>
<body>

<div class="title1">
  SafeShare <br> Privacy Preserving File Sharing Platform
</div>
      <div class="container1">
        <div class="box form-box">
           
            <header><center>Log-in</center></header>
            <form action="php/login.inc.php" method="post">
                <div class="field input">
                    <label for="username">User ID</label>
                    <input type="text" name="empid" id="empid" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
                <div class="links">
                    Admin LogIn : <a href="adminlogin.php">LogIn as an Admin</a>
                </div>
            </form>

            <?php
              if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                  echo "<script>alert('Fill-In All Fields!!');</script>";
                }
                else if($_GET["error"] == "wrongLogin"){
                  echo "<script>alert('Invalid Username!!');</script>";
                }
                else if($_GET["error"] == "wrongpwd"){
                  echo "<script>alert('Wrong Password!!');</script>";
                } 
                else if($_GET["error"] == "OTPEXP"){
                  echo "<script>alert('OTP Expired!!');</script>";
                }
                else if($_GET["error"] == "NONE"){
                  echo "<script>alert('User Profile is Created. Please Login!!');</script>";
                }
                
              }
            ?>
            
        </div>
      
      </div>
</body>
</html>