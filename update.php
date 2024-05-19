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
                <center><u><p class = "logo">UPDATE YOUR DATA</p></u></center>
                <br>

        
             <center><div class="box form-box">
             <form action="php/update.inc.php" method="post">

            <div class="field input">
                    <input type="hidden" name="userId" value="<?php echo $_SESSION['U_ID']; ?>"
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

            <div class="field">
                <input type="submit" class="btn" name="submit" value="UPDATE" required>
            </div>
            <div class="field">
                Chage Your Password <a href="updatePass.php">Change Password</a>
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