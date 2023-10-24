<?php
session_start();

// initializing variables
//$firstname = "";
//$lastname = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'iics_db');
// LOGIN USER
if (isset($_POST['login_btn'])) {
  $username = mysqli_real_escape_string($db, $_POST['user_id']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM users WHERE user_id='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['user_id'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: login_success.html');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>