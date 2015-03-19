<?php
session_start();

require_once("./includes/functions.php");

unset($_SESSION['sess_id']);
unset($_SESSION['sess_user_id']);
unset($_SESSION['sess_user_name']);
unset($_SESSION['sess_name']);
//unset($_SESSION['sess_email']);


pageback('signin.php','');
?>