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
    <title>Edit User</title>

</head>

<body>
    
    <div class="nav">

        <div class="logo">
            <p><a href="adControl.php">SafeShare - Privacy Preserving File Sharing Platform</a> </p>
        </div>

       

        <div class="right-links">
            
            <?php 
            
            $adid = $_SESSION['U_ID'];
            $query = mysqli_query($conn,"SELECT * FROM admin WHERE admid= $adid");

            while($result = mysqli_fetch_assoc($query)){
                $ad_Uname = $result['adName'];
                $ad_Email = $result['adEmail'];
                $ad_id = $result['adUname'];
            }
            
            ?>


            <?php 
            
            $uid = $_GET['uID'];
            $query = mysqli_query($conn,"SELECT*FROM sysuser WHERE userID=$uid");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['empName'];
                $res_Email = $result['email'];
                $res_Age = $result['age'];
                $res_id = $result['empId'];
                $res_dpt = $result['department'];
                $res_pwd = $result['password'];
            }
            


            ?>
            <a href="php/adlogout.inc.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>
    <div class="main-box top">
       
       <div class="top">
         <div class="box">
             <p>Hello <b><?php echo $ad_Uname ?></b>, Welcome!!</p>
         </div>
         <div class="box">
         <a href="adControl.php"> <button class="btn">System Users</button> </a>
         </div>
         <div class="box">
             <p>Your Admin ID is:  <b><?php echo $ad_id ?></b>.</p>
         </div>
       </div>
          <div class="bottom">
            <div class="box">
                <center><u><p class = "logo">UPDATE USER DATA</p></u></center>
                <br>

        
             <center><div class="box form-box">
             <form action="php/updateuserad.inc.php" method="post">

            <div class="field input">
                    <input type="hidden" name="userId" value="<?php echo $uid; ?>"
                 <label for="username">User ID</label>
                    <input type="text" name="empid" id="username" value="<?php echo $res_id; ?>" required>
            </div>

            <div class="field input">
                <label for="empName">User's Name</label>
                    <input type="text" name="empName" id="empname"  value="<?php echo $res_Uname; ?>" required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                    <input type="text" name="email" id="email"  value="<?php echo $res_Email; ?>" required>
            </div>

            <div class="field input">
                <label for="department">Select Your Department</label>
                    <select name="department" value="<?php echo $res_dpt; ?>">
                    <option value="HR">HR </option>
                    <option value="IT">IT </option>
                    <option value="Finance">Finance </option>
                    </select>
            </div>

            <div class="field input">
                 <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" required>
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
                    else if($_GET["error"] == "Invalid_Useername"){
                        echo "<script>alert('Invalid User ID!!');</script>";
                    }
                    else if($_GET["error"] == "Invalid_Email"){
                        echo "<script>alert('Invalid Email!!');</script>";
                    }
                    else if($_GET["error"] == "Username Exists!!"){
                        echo "<script>alert('User ID Exists!!');</script>";
                    }
                    else if($_GET["error"] == "none"){
                        echo "<script>alert('User Profile Updated!!!');</script>";
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