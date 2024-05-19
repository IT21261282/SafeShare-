<?php
  if (isset($_POST["submit"])){

    $empid= $_POST["empid"];
    $name= $_POST["empName"];
    $email= $_POST["email"];
    $dptmt= $_POST["department"];
    $age= $_POST["age"];
    $sKey= openssl_random_pseudo_bytes(16);
    $pwd= $_POST["password"];
    $pwdrp= $_POST["rpassword"];

    require_once'config.inc.php';
    require_once'functions.inc.php';

    if (emptyInputSignup($empid, $name, $email, $dptmt, $age, $sKey, $pwd, $pwdrp) !== false){
      header("location: ../register.php?error=Empty_Input");
      exit();
    }
    if (invalidUsername($empid) !== false){
      header("location: ../register.php?error=Invalid_Useername");
      exit();
    }
    if (invalidEmail($email) !== false){
      header("location: ../register.php?error=Invalid_Email");
      exit();
    }
    if (pwdMatch($pwd,$pwdrp) !== false){
      header("location: ../register.php?error=Password Dont Match");
      exit();
    }

    if (UnameExists($conn,$empid) !== false){
      header("location: ../register.php?error=Username Exists!!");
      exit();
    }

    if (strlen($pwd) < 12) {
      header("location: ../register.php?error=shrtpwd!!");
      exit();
    }

    $sql = "INSERT INTO sysuser(empId, empName, email, department, age, secretKey, password) VALUES(?,?,?,?,?,?,?) ; ";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)){
      header("location: ../register.php?error=STMT_FAILED!");
      exit();
    }

    $sKey=bin2hex($sKey);
    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $empid, $name, $email, $dptmt, $age, $sKey, $hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $currentDateTime = date("Y-m-d H:i:s");
    $activity = "New user profile created.";

    #System Logs:
    $query1 = mysqli_prepare($conn, "INSERT INTO userlogs(empId, empName, email, dateNtime, activity) VALUES(?,?,?,?,?); ");
    mysqli_stmt_bind_param($query1, "sssss", $empid, $name, $email, $currentDateTime, $activity);
    mysqli_stmt_execute($query1);

    header("location:../index.php?error=NONE");

    exit();

  }

  else{
    header("location: ../register.php");
    exit();
  }

  
?>