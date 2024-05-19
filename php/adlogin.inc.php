<?php
  if (isset($_POST["submit"])){
    $admId= $_POST["adId"];
    $pwd= $_POST["password"];

    require_once 'config.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputlogin($admId, $pwd) !== false){
      header ("location: ../adminlogin.php?error=emptyinput");
      exit();
    }

    $UnameExists = adminExists($conn,$admId);

    if($UnameExists === false){
      header("location: ../adminlogin.php?error=wrongLogin");
      exit();
    }

    $hashedpwd = $UnameExists["password"];
    $checkpwd = password_verify($pwd, $hashedpwd);

    if ($checkpwd === false){
      header("location:../adminlogin.php?error=wrongpwd");
      exit();
    }
    else if($checkpwd === true){
      session_start();
      $_SESSION["U_ID"] = $UnameExists["admid"];
      $_SESSION["Username"] = $UnameExists["adUname"];
      header("location:../adControl.php");
      exit();
    }
  }
  else {
    header("location: ../adminlogin.php");
  }
?>