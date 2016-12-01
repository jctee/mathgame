<?php

// Check if logged in
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == 'yes') {
	header('Location: index.php');
}

$error = false;

// If isset or email isnt correct
if(!isset($_POST['email']) || $_POST['email'] !== "a@a.a") {
  $error = true;
}

// If isset or password isnt correct
if(!isset($_POST['password']) || $_POST['password'] !== "aaa") {
  $error = true;
}

// If anything was login details were incorrect redirect
if($error) {
  header("Location: login.php?msg=Invalid%20login%20credentials.");
} else {

	// Set session for login
  $_SESSION['login'] = 'yes';
  header("Location: index.php");
  die();
}

?>
