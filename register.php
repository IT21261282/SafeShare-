<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style1.css">
    <title>Register</title>
</head>
<body>
    
<div class="title1">
  SafeShare - Privacy Preserving File Sharing Platform
</div>

      <div class="container">
        <div class="box form-box">

            <header><center>Sign Up</center></header>
            <form action="php/signup.inc.php" method="post">

                <div class="field input">
                    <label for="username">User ID</label>
                    <input type="text" name="empid" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="empName">User's Name</label>
                    <input type="text" name="empName" id="empname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                <label for="department">Select Your Department</label>
                    <select name="department">
                    <option value="HR">HR </option>
                    <option value="IT">IT </option>
                    <option value="Finance">Finance </option>
                    </select>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <!--<div class="field input">
                    <label for="SecretKey">Secret Key</label>
                    <input type="" name="skey" id="skey" autocomplete="off" required>
                </div>-->

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="repassword">Re-Enter Password</label>
                    <input type="password" name="rpassword" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
            <?php
            if(isset($_GET["error"])){
              if($_GET["error"] == "Empty_Input"){
                echo "<script>alert('Fill-in All Fields!!');</script>";
              }
              else if($_GET["error"] == "Invalid_Useername"){
                echo "<script>alert('Invalid User ID!!');</script>";
              }
              else if($_GET["error"] == "Invalid_Email"){
                echo "<script>alert('Invalid Email!!');</script>";
              }
              else if($_GET["error"] == "Password Dont Match"){
                echo "<script>alert('Passwords Don't Match!!');</script>";
              }
              else if($_GET["error"] == "Username Exists!!"){
                echo "<script>alert('User ID Exists!!');</script>";
              }
              else if($_GET["error"] == "NONE"){
                echo "<script>alert('Profile Created. Please Login!!');</script>";
              }
              else if($_GET["error"] == "shrtpwd!!"){
                echo "<script>alert('Password too short. Please input atleast 12 characters!!');</script>";
              }
            }

          ?>
        </div>

       
      </div>

</body>
</html>