<?php

session_start();

  if (isset($_POST["submit"])){

    $empid= $_POST["empid"];
    $name= $_POST["empName"];
    $email= $_POST["email"];
    $dptmt= $_POST["department"];
    $age= $_POST["age"];
    $sender= $_POST["userId"];

    require_once'config.inc.php';
    require_once'functions.inc.php';

    if (invalidUsername($empid) !== false){
      header("location: ../adupdateuser.php?error=Invalid_Useername");
      exit();
    }
    if (invalidEmail($email) !== false){
      header("location: ../adupdateuser.php?error=Invalid_Email");
      exit();
    }


    $sql = "UPDATE sysuser SET empId= '$empid', empName ='$name', email='$email', department='$dptmt', age='$age' WHERE empId='$sender';";
    $result = mysqli_query($conn,$sql);
    if ($result){

      $id = $_SESSION['U_ID'];
      $currentDateTime = date("Y-m-d H:i:s");
      $activity = "User updated profile details.";

      userLogs($conn, $id, $currentDateTime, $activity);

      header("location:../adupdateuser.php?error=none");
    }

  }

  else{
    header("location: ../adupdateuser.php");
    exit();
  }
?>