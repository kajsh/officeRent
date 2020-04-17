<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./../sign.php");
    exit;
}
// Include config file
require_once "config/config.php";
$Email = $_SESSION["Email"];
$sql = "SELECT Name,Rentee FROM users WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = $Email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                                   
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $Name, $Rentee);
                    if(mysqli_stmt_fetch($stmt)){

                    } else {
                    	echo "Something went wrong. Please try again later.";
            		}
            // Close statement
            mysqli_stmt_close($stmt);
        	}
    
    		// Close connection
    		mysqli_close($link);   
    	}

?>
 
