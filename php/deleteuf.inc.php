<?php

session_start();

include_once 'functions.inc.php';
include_once 'config.inc.php';

// Use the function to delete a file
$fileID = $_GET['fileID']; 


//Function deleting a received file.

function deleteFile($conn, $fileID) {

    // Prepare and execute the SQL query to delete the file
    $sql = "DELETE FROM userfiles WHERE fileID = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $fileID);
    mysqli_stmt_execute($stmt);

    // Check if the file was deleted successfully
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        return true;
    } else {
        return false;
    }
}
if (deleteFile($conn, $fileID)) {

    $id = $_SESSION['U_ID'];
    $currentDateTime = date("Y-m-d H:i:s");
    $activity = "File deleted from the system.";
  
    userLogs($conn, $id, $currentDateTime, $activity);

    header("location:../userFiles.php?error=dNone");
} else {
    header("location:../userFiles.php?error=Failed");
}

?>