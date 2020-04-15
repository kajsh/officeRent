<?php
// Include config file
require_once "config/config.php";

// Define variables and initialize with empty values
$Email = $Password = "";
$Email_err = $Password_err = "";
 
// Processing form data when form is submitted
if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['signInSubmit'])){
 
    // Check if Email is empty
    if(empty(trim($_POST["Email"]))){
        $Email_err = "Please enter your Email";
    } else{
        $Email = trim($_POST["Email"]);
    }
    
    // Check if upass is empty
    if(empty(trim($_POST["Password"]))){
        $Password_err = "Please enter your Password";
    } else{
        $Password = trim($_POST["Password"]);
    }
    
    // Validate credentials
    if(empty($Email_err) && empty($Password_err)){
        $sql = "SELECT Name,Email,Password FROM users WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = $Email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                // Check if Email exists, if yes then verify upass
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $Name, $Email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($Password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();                                                   

                              // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["Name"] = $Name;

                            // Redirect user to dashboard page
                            header("location: backend/dashboard.php");

                        } else{
                            // Display an error message if upass is not valid
                            $Password_err = "Password not valid.";
                        }
                    }
                } else{
                    // Display an error message if Email doesn't exist
                    $Email_err = "Email does not exist.";
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    
    // Close connection
    mysqli_close($link);
}
}
?>