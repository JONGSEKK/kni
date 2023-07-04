<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
        function validateForm(event) {
            //event.preventDefault(); // Prevent form submission
            
            // Verify reCAPTCHA response
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
				event.preventDefault();
                alert('Please complete the reCAPTCHA.');
                return;
            }
            
            // Submit the form if reCAPTCHA is completed
            //document.getElementById("registrationForm").submit();
        }
    </script>
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form id="registrationForm" method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>" required>
  	</div>
	  <div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="firstname" value="<?php echo $firstname; ?>" required>
  	</div>
	  <div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="lastname" value="<?php echo $lastname; ?>" required>
  	</div>
	  <div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>" required>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" required>
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" required>
  	</div>
	<div class="g-recaptcha" data-sitekey="6LfAcswmAAAAAPpOa-C5GCqRxRJdXN6d0n3cKgLR"></div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user" onclick="validateForm(event)">Register</button>
  	</div>
	
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>
