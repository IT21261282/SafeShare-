<?php

include_once 'functions.inc.php';
include_once 'config.inc.php';

// Use the function to delete a file
$uID = $_GET['uID']; 

//Function for deleting an existing user. Only for admins.

function deleteUser($conn, $uID) {

    $sql = "DELETE FROM sysuser WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
  
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "s", $uID);
    mysqli_stmt_execute($stmt);
  
  
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        return true;
    } else {
        return false;
    }
  }
  
if (deleteUser($conn, $uID)) {
    header("location:../adControl.php?error=dNone");
} else {
    header("location:../adControl.php?error=Failed");
}

?>