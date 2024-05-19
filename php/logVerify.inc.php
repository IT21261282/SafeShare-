<?php
session_start();

  if (isset($_POST["submit"])){
    $otp= $_POST["otp"];

    require_once 'config.inc.php';
    require_once 'functions.inc.php';

    $otp_expiry = strtotime($_SESSION['time_o']);
    $s_otp = $_SESSION['otp'];
 
    if ($s_otp == $otp){
       if ($otp_expiry >= time()){

        $id = $_SESSION['U_ID'];
        $currentDateTime = date("Y-m-d H:i:s");
        $activity = "User logged in to the system.";

        userLogs($conn, $id, $currentDateTime, $activity);
        header ("location: ../home.php");
        exit();
       } 
       else {
        header("location: ../index.php?error=OTPEXP");
       }
    }
    else{
        header("location: ../logVerify.php?error=OTPWRG");
    }
  }
  else {
    header("location: ../logVerify.php?error=emptyinput");
  }
?>
