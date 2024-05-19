<?php 

session_start();

include_once 'config.inc.php';
include_once 'functions.inc.php';

if (isset($_GET['fileID'])) {

  $fileID = $_GET['fileID'];

  $id = $_SESSION['U_ID'];
  $currentDateTime = date("Y-m-d H:i:s");
  $activity = "File downloaded from the system.";

  userLogs($conn, $id, $currentDateTime, $activity);
          
  // Retrieve the file data from the database
  $sql = "SELECT * FROM files WHERE fileID = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
      return false;
  }

  mysqli_stmt_bind_param($stmt, "s", $fileID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
      $content = $row['content'];
      $sender = $row['empId'];
      $iV1 = $row['iVector'];

      // Retrieve the secret key for decryption
      $sql = "SELECT secretKey FROM sysuser WHERE empId = ?";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
          return false;
      }

      mysqli_stmt_bind_param($stmt, "s", $sender);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
          $sKey = $row['secretKey'];

          // Decrypt the content
          $iv = hex2bin($iV1);
          $sKey = hex2bin($sKey);
          $decryptedContent = openssl_decrypt($content, 'aes-128-cbc', $sKey, OPENSSL_RAW_DATA, $iv);
          //$decryptedContent = openssl_decrypt($content, 'des-ede3', $sKey, OPENSSL_RAW_DATA, $sKey);

          $decryptedContent = base64_decode($decryptedContent);
          
          //$filename = basename($decryptedContent);

          // Set the appropriate headers for file download
          header('Content-Type: application/pdf');
          header('Content-Disposition: attachment; filename="' . basename($decryptedContent) . '"');
          header('Content-Length: ' . filesize($decryptedContent));
          readfile($decryptedContent);

          exit();
      }
  }

  return false;

}

header('Location: ../home.php');
exit();


?>
