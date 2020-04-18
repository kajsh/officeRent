<?php
// Include config file
require_once "config/config.php";
 
// Define variables and initialize with empty values
$rName = $rPassword = $rEmail = $rRentee = "";
$rName_err = $rPassword_err = $rEmail_err = $rRentee_err = "";
 
// Processing form data when form is submitted
if(isset($_POST['signUpSubmit'])) {

    // Validate name
    if(empty(trim($_POST["rName"]))){
        $rName_err = "Please enter your name.";     
    } else{
        $rName = trim($_POST["rName"]);
    }
 
    // Validate email
    if(empty(trim($_POST["rEmail"]))){
        $rEmail_err = "Please enter your Email.";
    } else{
        if (!filter_var($_POST["rEmail"], FILTER_VALIDATE_EMAIL)) {
            $rEmail_err = "Invalid email format";
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = trim($_POST["rEmail"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $rEmail_err = "Email already exists.";
                } else {
                    $rEmail = trim($_POST["rEmail"]);
                }
            } }else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["rPassword"]) === 0){
        $rPassword_err = "Password must be at least 8 characters and contain at least 1 lower case letter, 1 upper case letter and 1 digit";
    } else{
        $rPassword = trim($_POST["rPassword"]);
    }
    
    // Validate rentee
    if(isset($_POST['rRentee'])){
        if(($_POST["rRentee"]) == "rentee"){
            $rRentee = "1";
        } else 
            $rRentee = "0";
    } else
        $rRentee_err = "Please choose an option.";  
    
    
    // Check input errors before inserting in database
    if(empty($rName_err) && empty($rPassword_err) && empty($rEmail_err) && empty($rRentee_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (Name, Email, Password, Rentee) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_password, $param_rentee);
            
            // Set parameters
            $param_name = $rName;
            $param_email = $rEmail;
            $param_password = password_hash($rPassword, PASSWORD_DEFAULT); // Creates a password hash
            $param_rentee = $rRentee;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                session_start();

                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["Email"] = $rEmail;

                // Redirect to dashboard page
                header("location: dashboard.php");

            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
