<?php
    require_once 'config.inc.php';
    require_once 'functions.inc.php';

  session_start();
  session_unset();
  session_destroy();

  header("location:../index.php");
?>
