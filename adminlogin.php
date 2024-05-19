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
    <title>Admin Login</title>
</head>
<body>

<div class="title1">
    SafeShare - Privacy Preserving File Sharing Platform
</div>
      <div class="container">
        <div class="box form-box">
           
            <header><center>Admin Login</center></header>
            <form action="php/adlogin.inc.php" method="post">
                <div class="field input">
                    <label for="Id">Admin ID </label>
                    <input type="text" name="adId" id="adId" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
               
                <div class="links">
                    User LogIn : <a href="index.php">LogIn as a User</a>
                </div>
            </form>
            <?php
                 if(isset($_GET["error"])){
                    
                    if($_GET["error"] == "wrongLogin"){
                      echo "<script>alert('Invalid Username!!');</script>";
                    }
                    else if($_GET["error"] == "wrongpwd"){
                      echo "<script>alert('Wrong Password!!');</script>";
                    }
                  }
              
            ?>
        </div>
      
      </div>
</body>
</html>