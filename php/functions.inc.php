<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Function for checking empty inputs.

function emptyInputSignup($empid, $name, $email, $dptmt, $age, $sKey, $pwd, $pwdrp){
    $results;
    if (empty($empid) || empty($name) || empty($email) || empty($dptmt) || empty($age) || empty($sKey) || empty($pwd) || empty($pwdrp)) {
      $results = true;
    }
    else{
      $results = false;
    }
    return $results;
  }

  //Function for checking the username a valid one.

  function invalidUsername($empid){
    $results;
    if (!preg_match("/^[a-zA-Z0-9]*$/",$empid)) {
      $results = true;
    }
    else{
      $results = false;
    }
    return $results;
  }

  // Function for checking the email a valid one.

  function invalidEmail($email){
    $results;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $results = true;
    }
    else{
      $results = false;
    }
    return $results;
  }

  //Function for checking the both password fields do match.

  function pwdMatch($pwd,$pwdrp){
    $results;
    if ($pwd !== $pwdrp ){
      $results = true;
    }
    else{
      $results = false;
    }
    return $results;
  }

  //Function for checking the username already exists.

  function UnameExists($conn,$empid){
    $sql = "SELECT * FROM sysuser WHERE empId = ?; ";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)){
      header("location: ../register.php?error=STMT_FAILED!");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s",$empid);
    mysqli_stmt_execute($stmt);

    $resultsData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultsData)){
      return $row;
    }
    else{
      $result = false;
      return $result;
    }

   mysqli_stmt_close($stmt);
  }

  //Function for checking the input fields on the login page empty.

  function emptyInputlogin($empid,$pwd){
    $results;
    if (empty($empid) || empty($pwd)) {
      $results = true;
    }
    else{
      $results = false;
    }
    return $results;
  }

  //Function for logging the user to the system and sending the OTP.

  function loginUser($conn,$empid,$pwd){

    $UnameExists = UnameExists($conn,$empid);

    if($UnameExists === false){
      header("location: ../index.php?error=wrongLogin");
      exit();
    }

    $hashedpwd = $UnameExists["password"];
    $checkpwd = password_verify($pwd, $hashedpwd);

    if ($checkpwd === false){
      $id = $UnameExists["userID"];
      $currentDateTime = date("Y-m-d H:i:s");
      $activity = "Failed Login Attempt.";

      userLogs($conn, $id, $currentDateTime, $activity);
      header("location:../index.php?error=wrongpwd");
      exit();
    }
    else if($checkpwd === true){
       
      $otp = rand(100000, 999999);
      $otp_expiry = date("Y-m-d H:i:s", strtotime("+1 minute"));
      $subject= "SafeShare Login OTP";
      $message="Your OTP is: $otp" ;

      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'kyes7367@gmail.com'; //host email 
      $mail->Password = 'vhvrxqcgbojjfmsk'; // app password of your host email
      $mail->Port = 465;
      $mail->SMTPSecure = 'ssl';
      $mail->isHTML(true);
      $mail->setFrom('kyes7367@gmail.com', 'SafeShare - Privacy Preserving File Sharing Platform');//Sender's Email & Name
      $mail->addAddress($UnameExists["email"],$UnameExists["empName"]); //Receiver's Email and Name
      $mail->Subject = ("$subject");
      $mail->Body = $message;
      $mail->isHTML(true);  
      $mail->send();

      session_start();

      $_SESSION["U_ID"] = $UnameExists["userID"];
      $_SESSION["Username"] = $UnameExists["empName"];
      $_SESSION["otp"] = $otp;
      $_SESSION["time_o"] = $otp_expiry;

      header("location:../logVerify.php");
      exit();
    }
  }

  //Function for checking the entered admin username exists.

  function adminExists($conn,$admid){
    $sql = "SELECT * FROM admin WHERE adUname = ?; ";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)){
      header("location: ../adminlogin.php?error=STMT_FAILED!");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s",$admid);
    mysqli_stmt_execute($stmt);

    $resultsData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultsData)){
      return $row;
    }
    else{
      $result = false;
      return $result;
    }

   mysqli_stmt_close($stmt);
 }

 
//Functon for adding system logs.

function userLogs($conn, $id, $currentDateTime, $activity){
  
  $query = mysqli_query($conn,"SELECT*FROM sysuser WHERE userID=$id  ");

  while($result = mysqli_fetch_assoc($query)){
      $empName = $result['empName'];
      $Email = $result['email'];
      $empid = $result['empId'];
  }

  $query1 = mysqli_prepare($conn, "INSERT INTO userlogs(empId, empName, email, dateNtime, activity) VALUES(?,?,?,?,?); ");
    mysqli_stmt_bind_param($query1, "sssss", $empid, $empName, $Email, $currentDateTime, $activity);
    mysqli_stmt_execute($query1);

}



?>


