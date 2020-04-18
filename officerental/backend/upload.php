<?php
// Initialize the session
session_start();
// Include config file
require_once "config/config.php";
 
// Define variables and initialize with empty values
$FName = $LName = $ProofType = $IdNo = $Address = $Dob = $Contact = $UploadFile = "";
$FName_err = $LName_err = $ProofType_err = $IdNo_err = $Address_err = $Dob_err = $Contact_err = $UploadFile_err = "";

$Email = $_SESSION["Email"];

if(isset($_POST['submit'])) {

	// Validate fname
    if(empty(trim($_POST["FName"]))){
        $FName_err = "Please enter first name.";     
    } else{
        $FName = trim($_POST["FName"]);
    }

    // Validate lname
    if(empty(trim($_POST["LName"]))){
        $LName_err = "Please enter last name.";     
    } else{
        $LName = trim($_POST["LName"]);
    }

    // Validate prooftype
    if(isset($_POST["ProofType"])){
        if(($_POST["ProofType"]) == "aadhar"){
            $ProofType = "Aadhar";
        } else {
            $ProofType = "PAN";
        }
    } else {
        $ProofType_err = "Please choose an option.";  
    }

     // Validate idno
    if(empty(trim($_POST["IdNo"]))){
        $IdNo_err = "Please enter Id number.";     
    } else{
        $IdNo = trim($_POST["IdNo"]);
    }

     // Validate address
    if(empty(trim($_POST["Address"]))){
        $Address_err = "Please enter address.";     
    } else{
        $Address = trim($_POST["Address"]);
    }

     // Validate dob
    if(empty(trim($_POST["Dob"]))){
        $Dob_err = "Please enter your date of birth.";     
    } else{
        $Dob = trim($_POST["Dob"]);
    }

     // Validate lname
    if(empty(trim($_POST["Contact"]))){
        $Contact_err = "Please enter your date of birth.";     
    } else{
        $Contact = trim($_POST["Contact"]);
    }


		$file = $_FILES['file'];

		$fileName = $_FILES['file']['name']; 
		$fileTmpName = $_FILES['file']['tmp_name']; 
		$fileSize = $_FILES['file']['size']; 
		$fileError = $_FILES['file']['error']; 


		$fileExt = explode('.',$fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg','jpeg','png','pdf');

		if (in_array($fileActualExt, $allowed)) {
			if($fileError === 0){
				if($fileSize < 1000000) {
					$UploadFile = uniqid('',true).".".$fileActualExt;
					$fileDestination = 'uploads/'.$UploadFile;
					move_uploaded_file($fileTmpName, $fileDestination);
					
				} else {
					$UploadFile_err = "File size cannot be greater than 10mb.";
				}
			} else {
				$UploadFile_err = "Error uploading file.";
			}
		}
		else {
			$UploadFile_err = "Please upload image or pdf.";
		}
	
	// Check input errors before inserting in database
    if(empty($FName_err) && empty($LName_err) && empty($ProofType_err) && empty($IdNo_err) && empty($Address_err) && empty($Dob_err) && empty($Contact_err) && empty($UploadFile_err)) {

 
		$sql = "SELECT UserId FROM users WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = $Email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                                   
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $UserId);
                    if(mysqli_stmt_fetch($stmt)){

                    } else {
                    	echo "Something went wrong. Please try again later.";
            		}
        	} 
    	}
        
        // Prepare an insert statement
        $sql = "INSERT INTO renteekyc (UserId, FName, LName, ProofType, IdNo, Address, Dob, Contact, UploadFile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_UserId, $param_FName, $param_LName, $param_ProofType, $param_IdNo, $param_Address, $param_Dob, $param_Contact, $param_UploadFile);
            
            // Set parameters
            $param_UserId = $UserId;
            $param_FName = $FName;
            $param_LName = $LName;
            $param_ProofType = $ProofType;
            $param_IdNo = $IdNo;
            $param_Address = $Address;
            $param_Dob = $Dob;
            $param_Contact = $Contact;
            $param_UploadFile = $UploadFile;
           
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to dashboard page
                header("location: officeDetails.php");
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