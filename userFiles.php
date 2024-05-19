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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Home</title>
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
    <style>
    .download-link {
        display: inline-block;
        padding-right: 20px; /* Adjust as needed */
        background: url('uploads\189249.png') no-repeat right center; /* Use the path to your icon */
    }
</style>
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
            $query = mysqli_query($conn,"SELECT*FROM sysuser WHERE userID=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['empName'];
                $res_Email = $result['email'];
                $res_Age = $result['age'];
                $res_id = $result['empId'];
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
            <a href="share.php"> <button class="btn">Send Files</button> </a>
            </div>
            <div class="box">
            <a href="uploadFiles.php"> <button class="btn">Upload Files</button> </a>
            </div>
            <div class="box">
            <a href="home.php"> <button class="btn">View Received Files</button> </a>
            </div>

            <div class="box">
                <p>Your User ID is:  <b><?php echo $res_id ?></b>.</p>
            </div>

          </div>

          <div class="bottom">
            
            <div class="box">
                <center><u><p class = "logo">YOUR UPLOADED FILES</p></u></center>
                <br>
                <?php
                        $sql = "SELECT * FROM userfiles WHERE empId = ?; ";
                        $stmt = mysqli_stmt_init($conn);
                    
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            header("location: ../home.php?error=STMT_FAILED!");
                            exit();
                        }
                    
                        mysqli_stmt_bind_param($stmt, "s", $res_id);
                        mysqli_stmt_execute($stmt);
                    
                        $resultsData = mysqli_stmt_get_result($stmt);
                    
                    
                        if(mysqli_num_rows($resultsData) > 0) {
                    
                            echo "<table>";
                            echo "<tr><th>File ID</th><th>File Name</th><th>Special Notes</th><th>Actions</th></tr>";
                    
                            // Fetch and display each file
                            while ($row = mysqli_fetch_assoc($resultsData)) {
                                echo "<tr>";
                                echo "<td>" . $row['fileId'] . "</td>";
                                echo "<td>" . $row['fileName'] . "</td>";
                                echo "<td>" . $row['spNotes'] . "</td>";
                                echo "<td>";
                                echo "<a href='php/downloaduf.inc.php?fileID=" . $row['fileId'] . "' class= 'download-link'>Download</a> ";
                                echo "<a href='php/deleteuf.inc.php?fileID=" . $row['fileId'] . "'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                    
                    
                            echo "</table>";
                        } else {
                            echo "No files found.";
                        }
                ?> 

                <?php
                     if(isset($_GET["error"])){
         
                        if($_GET["error"] == "dNone"){
                            echo "<script>alert('File Deleted!!');</script>";
                        }
                        else if($_GET["error"] == "Failed!"){
                            echo "<script>alert('File Deletion Failed!!');</script>";
                        }
                        else if($_GET["error"] == "dFailed!"){
                            echo "<script>alert('File Download Failed!!');</script>";
                        }
                        else if($_GET["error"] == "doNone!"){
                            echo "<script>alert('File will be Downloaded!!');</script>";
                        }
                     }
                ?>
            </div>
          </div>
       </div>

    </main>
</body>
</html>