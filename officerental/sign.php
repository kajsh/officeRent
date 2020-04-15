<?php include ('backend/login.php'); ?>
<?php include ('backend/register.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="css\sign.css">
 <script src="https://kit.fontawesome.com/3aad245445.js" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span class="info">or use your email for registration</span>
				<input type="text" name="rName" placeholder="Name" value="<?php echo $rName;?>">
                <span class="help-block"><?php echo $rName_err; ?></span>

				<input type="text" name="rEmail" placeholder="Email" value="<?php echo $rEmail;?>">
                <span class="help-block"><?php echo $rEmail_err; ?></span>

                <input type="password" name="rPassword" placeholder="Password" value="<?php echo $rPassword;?>">
                <span class="help-block"><?php echo $rPassword_err; ?></span>
			<select name="rRentee">
			  <option class="hidden"  selected disabled>Are you a rentee or a renter?</option>
			  <option value="rentee">Rentee</option>
			  <option value="renter">Renter</option>
			</select>
			<span class="help-block"><?php echo $rRentee_err; ?></span>
			<button name="signUpSubmit" id="signUpSubmit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span class="info">or use your account</span>
                <input type="text" name="Email" placeholder="Email" value="<?php echo $Email;?>">
                <span class="help-block"><?php echo $Email_err; ?></span>

                <input type="password" name="Password" placeholder="Password" value="<?php echo $Password;?>">
                <span class="help-block"><?php echo $Password_err; ?></span>
            
			<a href="#">Forgot your password?</a>
			<button name="signInSubmit" id="signInSubmit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<script>const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    const signUpSubmitButton = document.getElementById('signUpSubmit');
    const signInSubmitButton = document.getElementById('signInSubmit');

    signUpSubmitButton.addEventListener('click',()=> {
    	// Test whether browser has HTML5 storage capability
         if (typeof (Storage) !== "undefined") {
         	sessionStorage.clicked="false";
         }
    });

    signInSubmitButton.addEventListener('click',()=> {
    	// Test whether browser has HTML5 storage capability
         if (typeof (Storage) !== "undefined") {
         	sessionStorage.clicked="true";
         }
    });
         jQuery.noConflict()(function ($) { 
    $(document).ready(function() { 
       if(sessionStorage.clicked=="false"){
       		container.classList.add("right-panel-active");
       }
    });
});
     


    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });</script>
</body>
</html>


