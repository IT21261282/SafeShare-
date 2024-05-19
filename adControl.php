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
    <title>Admin Control Panel</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f2f2f2;
    }
</style>
</head>

<body>
    
    <div class="nav">

        <div class="logo">
            <p><a href="home.php">SafeShare - Privacy Preserving File Sharing Platform</a> </p>
        </div>

       

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['U_ID'];
            $query = mysqli_query($conn,"SELECT * FROM admin WHERE admid= $id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['adName'];
                $res_Email = $result['adEmail'];
                $res_id = $result['adUname'];
            }
            

            ?>

            <a href="php/adlogout.inc.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
       
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome!!</p>
            </div>
            <div class="box">
            <a href="adminMonLogs.php"> <button class="btn">View System Logs</button> </a>
            </div>
            <div class="box">
                <p>Your Admin ID is:  <b><?php echo $res_id ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">

                <center><u><p class = "logo">System Users</p></u></center>
                <br>

                <?php
                
                    $sql = "SELECT * FROM sysuser; ";
                    $stmt = mysqli_stmt_init($conn);
                  
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: ../adControl.php?error=STMT_FAILED!");
                        exit();
                    }
                  
                    mysqli_stmt_execute($stmt);
                  
                    $resultsData = mysqli_stmt_get_result($stmt);
                  
                    if(mysqli_num_rows($resultsData) > 0) {
                  
                        echo "<table>";
                        echo "<tr><th>User ID</th><th>User ID</th><th>Emp. Name</th><th>Email</th><th>Department</th><th>Action</th></tr>";
                  
                        // Fetch and display each file
                        while ($row = mysqli_fetch_assoc($resultsData)) {
                            echo "<tr>";
                            echo "<td>" . $row['userID'] . "</td>";
                            echo "<td>" . $row['empId'] . "</td>";
                            echo "<td>" . $row['empName'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['department'] ."</td>";
                            echo "<td>";
                            echo "<a href='php/deleteUser.inc.php?uID=" . $row['userID'] . "'>Delete</a>";
                            echo "<br>";
                            echo "<a href='adupdateuser.php?uID=" . $row['userID'] . "'>Edit Profile</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                  
                  
                        echo "</table>";
                    } else {
                        echo "No files found.";
                    }
                ?> 
                
            </div>
          </div>
       </div>

    </main>
</body>
</html>