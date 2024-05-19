<?php
    require_once 'config.inc.php';
    require_once 'functions.inc.php';

  session_start();

  $id = $_SESSION['U_ID'];
  $currentDateTime = date("Y-m-d H:i:s");
  $activity = "Logged out of the system.";

  session_unset();
  session_destroy();

  userLogs($conn, $id, $currentDateTime, $activity);
  
  header("location:../index.php");
?>
