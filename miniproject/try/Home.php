<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>home</title>
    
    
</head>
  <link rel="stylesheet" href="css/style.css" charset="UTF-8">
<body>
<div class="background "></div>
<center>
    <div class="sign">
        <h1>Welcome to Aladdin Swimming Pool !</h1>
    </div>
    
    <button class="homebuttons" onclick="window.location.href= 'http://localhost/abd/MemberRegistration.php';">Sign Up as Member</button><br>
	<br></br>
    <button class="homebuttons" onclick="window.location.href= 'http://localhost/abd/CoachRegistration.php';">Sign Up as Coach</button><br>
	<br></br>
    <button class="homebuttons" onclick="window.location.href= 'http://localhost/abd/Report.php';">Monthly Income Report</button><br>
    
	<br></br>
    <p>
        <a  href="logout.php">Log Out</a>
    </p>
	</center>
</body>
</html>