<?php
  if (isset($_POST["submit"])){
    $empid= $_POST["empid"];
    $pwd= $_POST["password"];

    require_once 'config.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputlogin($empid, $pwd) !== false){
      header ("location: ../index.php?error=emptyinput");
      exit();
    }

    loginUser($conn,$empid,$pwd);
  }
  else {
    header("location: ../index.php");
  }
?>
