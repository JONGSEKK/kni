<?php
session_start();

// initializing variables
$username = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'kni_system');

if (isset($_POST['login_admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = ($password);
  	$query = "SELECT * FROM admin WHERE admin_id='$username' AND admin_password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: admin_cust.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Administrator Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Administrator Login</h2>
  </div>

  <form action="login_admin.php" method="post" >
<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_admin" >Login</button>
  	</div>
  </form>
</body>
</html>
