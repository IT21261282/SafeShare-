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
    <title>Share Files</title>
    <style>
        #drop-area {
            border: 2px dashed #ccc;
            border-radius: 20px;
            width: 300px;
            height: 200px;
            text-align: center;
            padding: 20px;
            margin: 20px auto;
        }
        #drop-area.highlight {
            border-color: #009688;
        }
        p {
            margin: 0;
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
            <a href="home.php"> <button class="btn">Reveived Files</button> </a>
            </div>
            <div class="box">
            <a href="userFiles.php"> <button class="btn">View Your Files</button> </a>
            </div>
            <div class="box">
                <p>Your Username is:  <b><?php echo $res_id ?></b>.</p>
            </div>
          </div>
          <div class="bottom">

            <div class="box">

                <center><u><p class = "logo">SHARE FILES</p></u></center>
                <br>

             <center><div class="box form-box">

                <form action="php/share.inc.php" method="post" enctype="multipart/form-data">
            
                <input type="hidden" name="userId" value="<?php echo $_SESSION['U_ID']; ?>">

                <div class="field input">
                    <label for="username">Receiver's User ID</label>
                    <input type="text" name="empid" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="empName">File Name</label>
                    <input type="text" name="fileName" id="empname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="spcNotes">Special Notes</label>
                    <input type="text" name="spcNotes" id="spcNotes" autocomplete="off" required>
                </div>

                <div id="drop-area" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragenter="dragEnterHandler(event);" ondragleave="dragLeaveHandler(event);">
                    <p>Drag and drop files here</p>
                    <p>or</p>
                    <label for="file-input">Choose a file</label>
                    <input type="file" id="file-input" name ="content" multiple>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="UPLOAD" required>
                </div>
            </form>


            <?php
            if(isset($_GET["error"])){
         
              if($_GET["error"] == "Invalid_Useername"){
                echo "<script>alert('Invalid User ID!!');</script>";
              }
              else if($_GET["error"] == "STMT_FAILED!"){
                echo "<script>alert('Statement Failed');</script>";
              }
              else if($_GET["error"] == "NONE"){
                echo "<script>alert('File Shared Successfully!!');</script>";
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