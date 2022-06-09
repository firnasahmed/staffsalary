<?php
// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$cdate=date("Y-m-d H:i:s");
$error="";
$memberid="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["memberid"])){
        $error = "invlaid.";
    } else{
        $memberid = trim($_POST["memberid"]);
        $query="UPDATE swimmingschedule SET IsPaid=1,Piad_Date='$cdate' WHERE member_id=$memberid";
        if (mysqli_query($link, $query)) {        
            $error= "Paid successfully ";   
        } else {
            $error= "Error: " . $query . "<br>" . mysqli_error($link);
        } 
    }
    
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
    <a href="MemberRegistration.php" >Back</a>
    </div>
</body>
</html>