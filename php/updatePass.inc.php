<?php

session_start();

  if (isset($_POST["submit"])){

    $cpwd = $_POST["cpassword"];
    $pwd= $_POST["password"];
    $pwdrp= $_POST["rpassword"];
    $sender= $_POST["userId"];

    require_once'config.inc.php';
    require_once'functions.inc.php';
    
    $UnameExists = UnameExists($conn,$sender);

    $hashedpwd = $UnameExists["password"];
    
    //$currentpwd = password_hash($cpwd, PASSWORD_DEFAULT);

    $checkpwd = password_verify($cpwd, $hashedpwd);

    if ($checkpwd === false){
      header("location:../updatePass.php?error=wrongcpwd");
      exit();
    }
    else if(pwdMatch($pwd,$pwdrp) !== false){
      header("location: ../updatePass.php?error=Password Dont Match");
      exit();
    }
    else{

    $hashedpwd1 = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "UPDATE sysuser SET  password ='$hashedpwd1' WHERE empId='$sender';";
    $result = mysqli_query($conn,$sql);
        if ($result){

            $id = $_SESSION['U_ID'];
            $currentDateTime = date("Y-m-d H:i:s");
            $activity = "User changed the password.";

            userLogs($conn, $id, $currentDateTime, $activity);

            
    }
    header("location:../updatePass.php?error=none");
  }
}

  else{
    header("location: ../updatePass.php");
    exit();
  }
?>