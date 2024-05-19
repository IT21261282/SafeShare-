<?php

require_once 'config.inc.php';
require_once 'functions.inc.php';

session_start();

if (isset($_POST["submit"])){

  $empid= $_POST["empid"];
  $fileName= $_POST["fileName"];
  $spcNotes= $_POST["spcNotes"];
  $content= $_POST["file"];
  $sender= $_POST["userId"];
  $iv=openssl_random_pseudo_bytes(16);
  

   // Retrieve sender's empId
   $sender_id = null;
   $query = mysqli_prepare($conn, "SELECT empId FROM sysuser WHERE userID = ?");
   mysqli_stmt_bind_param($query, "s", $sender);
   mysqli_stmt_execute($query);
   $result = mysqli_stmt_get_result($query);

   if ($row = mysqli_fetch_assoc($result)) {
       $sender_id = $row['empId'];
   }


// Retrieve secretKey for encryption
   $sKey1 = null;
   $query1 = mysqli_prepare($conn, "SELECT secretKey FROM sysuser WHERE empId = ?");
   mysqli_stmt_bind_param($query1, "s", $empid);
   mysqli_stmt_execute($query1);
   $result1 = mysqli_stmt_get_result($query1);

   if ($row = mysqli_fetch_assoc($result1)) {
   $sKey1 = $row['secretKey'];
   }

   // Encrypt the content
   $encryptedData = openssl_encrypt($Content, 'aes-128-cbc', $sKey1, OPENSSL_RAW_DATA, $iv);
   $iV=bin2hex($iv);

   $encryptedData = base64_encode($encryptedData);
   //$encryptedData = openssl_encrypt($content, 'des-ede3', $sKey, OPENSSL_RAW_DATA, $sKey);

   // Insert the encrypted data into the database
   $sql = "INSERT INTO files (empId, fName, spcNotes, content, sender, iVector) VALUES(?, ?, ?, ?, ?, ?)";
   $stmt = mysqli_stmt_init($conn);

   if (!mysqli_stmt_prepare($stmt, $sql)){
       header("location: ../upload.php?error=STMT_FAILED!");
       exit();
   }

   mysqli_stmt_bind_param($stmt, "ssssss", $empid, $fileName, $spcNotes, $encryptedData, $sender_id, $iV);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);

   header("location:../upload.php?error=NONE");

  if (invalidUsername($empid) !== false){
    header("location: ../upload.php?error=Invalid_Useername");
    exit();
  }

  $id = $_SESSION['U_ID'];
  $currentDateTime = date("Y-m-d H:i:s");
  $activity = "File Shared to the system.";

  userLogs($conn, $id, $currentDateTime, $activity);

} else {
  header("location: ../share.php");
  exit();
}
?>
