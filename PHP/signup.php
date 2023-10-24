<?php
session_start();

// initializing variables
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'iics_db');

// REGISTER USER
if (isset($_POST['signup_btn'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['user_id']);
  $firstname = mysqli_real_escape_string($db, $_POST['f_name']);
  $lastname = mysqli_real_escape_string($db, $_POST['l_name']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($firstname)) { array_push($errors, "Firstname is required"); }
  if (empty($lastname)) { array_push($errors, "Lastname is required"); }
  if (empty($password)) { array_push($errors, "password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE user_id='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_id'] === $username) {
      array_push($errors, "Username already exists");
    }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (user_id, f_name, l_name, password) 
  			  VALUES('$username', '$firstname', '$lastname', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['user_id'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: ../html/loginPage.php');
  }
}

?>