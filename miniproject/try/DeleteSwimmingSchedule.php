<?php
// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$memberid="";
$sid="";
if(empty($_GET["memberid"]) | empty($_GET["sid"]) ){  
        header("location: MemberRegistration.php");
        exit; 
} else{
    $memberid=$_GET["memberid"];
    $sid=$_GET["sid"];
}

$query="DELETE FROM swimmingschedule WHERE id='$sid'";
if (mysqli_query($link, $query)) {      
  
    $error= "Deleted successfully "; 
    
   
} else {
    $error= "Error: " . $query . "<br>" . mysqli_error($link);
} 
?>  
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>home</title>
    
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <div>
    <div>
    <?php echo $error; ?>
    <br>
    <a href="SwimmingSchedule.php?memberid=<?php echo $memberid; ?>" >Back</a>
    </div>
</body>
</html>