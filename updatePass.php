<?php 
   session_start();

   require_once 'php/config.inc.php';
    require_once 'php/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style1.css">
    <title>Update User</title>

</head>

<body>
    
    <div class="nav">

        <div class="logo">
            <p><a href="home.php">SafeShare - Privacy Preserving File Sharing Platform</a> </p>
        </div>

       

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['U_ID'];
            $query = mysqli_query($conn,"SELECT*FROM sysuser WHERE userID=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['empName'];
                $res_Email = $result['email'];
                $res_Age = $result['age'];
                $res_id = $result['empId'];
                $res_dpt = $result['department'];
                $res_pwd = $result['password'];
            }
            
            echo "<a href='update.php?Id=$res_id'>Profile Settings</a>";

            ?>
            <a href="php/logout.inc.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
       
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome!!</p>
            </div>

            <div class="box">
                <p>Your User ID is:  <b><?php echo $res_id ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <center><u><p class = "logo">Change Your Password</p></u></center>
                <br>

        
             <center><div class="box form-box">
             <form action="php/updatePass.inc.php" method="post">

            <div class="field input">
                    <input type="hidden" name="userId" value="<?php echo $res_id; ?>"
            </div>

            <div class="field input">
                <label for="password">Current Password</label>
                    <input type="password" name="cpassword" id="cpassword" value="" >
            </div>

            <div class="field input">
                <label for="password">New Password</label>
                    <input type="password" name="password" id="password" value="" >
            </div>

            <div class="field input">
                <label for="repassword">Re-Enter New Password</label>
                    <input type="password" name="rpassword" id="password" value="">
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="UPDATE" required>
            </div>

            </form>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "Empty_Input"){
                        echo "<script>alert('Fill-in All Fields!!');</script>";
                    }

                    else if($_GET["error"] == "Password Dont Match"){
                        echo "<script>alert('Passwords Don't Match!!');</script>";
                    }

                    else if($_GET["error"] == "wrongcpwd"){
                        echo "<script>alert('Current Password is incorrect!!');</script>";
                    }

                    else if($_GET["error"] == "none"){
                        echo "<script>alert('User Password Updated!!!');</script>";
                    }
                }

            ?>
            </div></center>

            </div>
          </div>
       </div>

    </main>
</body>
</html>