<?php
session_start();
require_once("dbcontroller.php");

// initializing variables
$username = "";
$firstname ="";
$lastname ="";
$phonenumber="";
$email    = "";
$full_name_message = "";
$phone_number_message ="";
$email_message ="";
$message ="";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'kni_system');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
$phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
if (empty($firstname)) { array_push($errors, "First Name is required"); }
if (empty($lastname)) { array_push($errors, "Last Name is required"); }
if (empty($phonenumber)) { array_push($errors, "Phone Number is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM customer WHERE customer_id='$username' OR customer_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  $requiredChars = array('/[A-Z]/','/[a-z]/','/[0-9]/','/[\W]/',);

  if (strlen($password_1) < 8) {
      array_push($errors, "Password must be at least 8 characters long.");
  }

  // Check complex characters
  foreach ($requiredChars as $pattern) {
      if (!preg_match($pattern, $password_1)) {
        array_push($errors, "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.");
        break;
      }
  }

  // Check common passwords
  $commonPasswords = array('password', '123456', 'qwerty'); // Add more common passwords to the list
  if (in_array($password_1, $commonPasswords)) {
    array_push($errors, "Please choose a stronger password.");
  }

  if ($user) { // if user exists
    if ($user['customer_id'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['customer_email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  //if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    // Input contains only alphabetic characters, process it further
    //array_push($errors, "Username have invalid characters or numbers.");
  //}
  if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
    // Input contains only alphabetic characters, process it further
    array_push($errors, "First Name have invalid characters or numbers.");
  }
  if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
    // Input contains only alphabetic characters, process it further
    array_push($errors, "Last Name have invalid characters or numbers.");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = sha1($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO customer (customer_id, customer_firstname, customer_lastname, customer_phonenumber, customer_email, customer_password)
  			  VALUES('$username', '$firstname', '$lastname', '$phonenumber',  '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
// ...

// ...

// LOGIN USER
if (isset($_POST['login_user'])) {
  $db_handle = new DBController();
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = sha1($password);
    $query1 = "SELECT * FROM customer WHERE customer_id='$username'";
  	$results1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($results1);
    if (mysqli_num_rows($results1) == 1) {
      $query = "SELECT * FROM customer WHERE customer_id='$username' AND customer_password='$password'";
      $results = mysqli_query($db, $query);
      $row1 = mysqli_fetch_assoc($results);
      if (mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }else {
        array_push($errors, "Wrong password");
        $counts = $row["try_lock"];
        $tenMinutesLater = strtotime('+10 minutes', time()); // Add 10 minutes to the current timestamp
        $timestamp = date('Y-m-d H:i:s', $tenMinutesLater);
        echo '<script>alert("'.$timestamp.'");</script>';
        if($row["date"]==""){
          if($counts=="")
          {
            $counts = 1;
            echo '<script>alert("'.$counts.'");</script>';
            $query = "UPDATE customer set try_lock=".$counts." WHERE  customer_id='".$username."'";
            $result = $db_handle->executeQuery($query);
          }
          else if($counts<=2){
            $counts = $row["try_lock"]+1;
            $query = "UPDATE customer set try_lock=".$counts." WHERE  customer_id='".$username."'";
            $result = $db_handle->executeQuery($query);
          }
          else if($counts>2){
            $query = "UPDATE customer set try_lock=0,timestamp='$timestamp' WHERE  customer_id='".$username."'";
            $result = $db_handle->executeQuery($query);
          }
        }
        else if($row["date"]<$timestamp){
          array_push($errors, "Your account is locked");
        }
      }
    }else {
      array_push($errors, "Wrong username");
    }
  }
}

// contact us

	if (isset($_POST['send'])) {
  // receive all input values from the form
  $full_name_message = mysqli_real_escape_string($db, $_POST['full_name_message']);
  $phone_number_message = mysqli_real_escape_string($db, $_POST['phone_number_message']);
  $email_message = mysqli_real_escape_string($db, $_POST['email_message']);
  $message = mysqli_real_escape_string($db, $_POST['message']);

	// form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($full_name_message)) { array_push($errors, "Full Name is required"); }
  if (empty($phone_number_message)) { array_push($errors, "Phone Number is required"); }
  if (empty($email_message)) { array_push($errors, "Email is required"); }
  if (empty($message)) { array_push($errors, "Message is required"); }

if (count($errors) == 0) {

  	$query = "INSERT INTO contact_us (full_name, phone_number, email, message)
  			  VALUES('$full_name_message', '$phone_number_message', '$email_message', '$message')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}


?>
