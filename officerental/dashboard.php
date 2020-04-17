<?php include('backend/dash.php');?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
  	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">FOGO</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="list.php" id="list">List Space</a></li>
      <li><a href="#" id="find">Find Space</a></li>
      
      <li><button onclick="document.location.href='backend/logout.php';" class="btn btn-danger navbar-btn">Log Out</button></li>
    </ul>
  	</div>
	</nav>
	<h1><center>Hi, <b><span><?php echo $Name; ?> !</span></b></center></h1>

    <script>
    	jQuery.noConflict()(function ($) { 
    		$(document).ready(function() { 
    			if(<?php echo $Rentee; ?> == 0){
    				$("#list").hide();
    			}
    		});
    	});	
    </script>
</body>
</html>