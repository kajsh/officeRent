<?php include ('backend/upload.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
      span { color : red ; padding-left: 5px;}
    </style>
    <link rel="stylesheet" href="css/style.css">
     <title>List Space</title>
</head>
<body onload="disableSubmit()">
  <div class="container">
  <div class="header">
      <h2>Register</h2>
  </div>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
           
    <div class="form-group">
        <label>First Name(as per the document)</label>
    <br>
        <input type="text" name="FName" value="<?php echo $FName;?>">
        <span><?php echo $FName_err; ?></span>
     </div>
     
     <div class="form-group">
        <label>Last Name(as per the document)</label>
    <br>
        <input type="text" name="LName" value="<?php echo $LName;?>">
        <span><?php echo $LName_err; ?></span>
    </div>

    <div class="form-group">
        <label for="ptype">Proof Type</label>
        <br>
        <select name="ProofType">
        <option class="hidden" selected disabled>Select </option>
        <option value="aadhar">Aadhar</option>
        <option value="PAN">PAN Card</option>
      </select>
      <span><?php echo $ProofType_err; ?></span>
      </div>

    <div class="form-group">
        <label>Id Number(as per proof)</label>
        <br>
        <input type="text" name="IdNo" value="<?php echo $IdNo;?>">
        <span><?php echo $IdNo_err; ?></span>
        </div>
      
    <div class="form-group">
        <label> Address(as per proof)</label>
        <br>
        <input type="text" name="Address" value="<?php echo $Address;?>">
        <span><?php echo $Address_err; ?></span>
    </div>
    
    <div class="form-group">
         <label>Date of birth</label>
          <br>
         <input type="date" name="Dob" value="<?php echo $Dob;?>">
         <span><?php echo $Dob_err; ?></span>
    </div>
     
    <div class="form-group">
      <label>Contact Number</label> <br>
      <input type="text" name="Contact" value="<?php echo $Contact;?>">
      <span><?php echo $Contact_err; ?></span>
    </div>

    <div class="form-group">
      <label>Upload file</label>
      <input type="file" name="file">
      <span><?php echo $UploadFile_err; ?></span>
    </div>

    <div class="form-group">
       <input type="checkbox" name="terms" id="terms" onclick="myFunction()"> The above information is true to my knowledge.
       <br>
    </div>
    
    <div class="form-group">
    <br>
        <input type="submit" class="btn btn-primary" id="Submit" name="submit" value="Submit" disabled>
    </div>
    </form>
  </div>

    <script>
      function myFunction () {
        document.getElementById("Submit").disabled = false;
      }
    </script>
        
</body>
</html>



