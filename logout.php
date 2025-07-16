<?php
// include "database.php";
session_start();

unset($_SESSION['admin_id']);
unset($_SESSION['user_id']);
unset($_SESSION['authority_id']);

session_destroy();
echo "<script>window.open('index.php','_self');</script>";
