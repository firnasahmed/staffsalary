<?php
// Initialize the session
session_start();
require_once "config.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if(empty($_GET["memberid"])){
    header("location: MemberRegistration.php");
} 

$memberid=$_GET["memberid"];
$member_name="";
$member_phonenumber="";
$member_address="";
$member_gender="";
$query = "SELECT member_id,member_name, member_phonenumber, member_address, member_gender from members WHERE member_id=$memberid"; 
$member_rows="";
if ($result=mysqli_query($link,$query)) 
{ 
  while ($row=mysqli_fetch_row($result)) 
    { 
        $member_name=$row[1];
        $member_phonenumber=$row[2];
        $member_address=$row[3];
        $member_gender=$row[4];
    } 
  mysqli_free_result($result); 
}
$WithCoach=15;
$WithoutCoach=10;

$WithCoachTotalMin=0;
$WithCoachTotal=0;
$WithoutCoachTotalMini=0;
$WithoutCoachTotal=0;
$grandTotal=0;

$query = "SELECT id,member_id, coach_id, start_date, end_date, total_hours from swimmingschedule WHERE member_id=$memberid AND IsPaid Is Null"; 
$payed_rows="";
if ($result=mysqli_query($link,$query)) 
{ 
  while ($row=mysqli_fetch_row($result)) 
    { 
      $payed_rows = $payed_rows."<tr><td>".$row[0]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
      if($row[2]==0){
        $WithoutCoachTotalMini=$WithoutCoachTotalMini+$row[5];
      }else{
        $WithCoachTotalMin=$WithCoachTotalMin+$row[5];
      }
    } 
    $WithCoachTotal=$WithCoach*$WithCoachTotalMin;
    $WithoutCoachTotal=$WithoutCoach*$WithoutCoachTotalMini;
    $grandTotal=$WithCoachTotal+$WithoutCoachTotal;
  mysqli_free_result($result); 
}


?>
  <!DOCTYPE html>
<html>
<style>

 </style>
<head>
    <title>Home</title>
</head>
  <link rel="stylesheet" href="css/style.css" charset="UTF-8">
<body>
    <div class="homebuttons">
    <a class="homebuttons" href="Home.php">Home</a><br>
    </div>
    <div>
    <div class="sign">Member Details</div>
    <table>
        <tr><td>Id</td><td> <?php echo $memberid;?> </td></tr>
        <tr><td>Name</td><td> <?php echo $member_name;?> </td></tr>
        <tr><td>Phone</td><td> <?php echo $member_phonenumber;?> </td></tr>
        <tr><td>Address</td><td> <?php echo $member_address;?> </td></tr>
        <tr><td>Gender</td><td> <?php echo $member_gender;?> </td></tr>
        
    </table>
    
    </div>
   

    
    <hr>
    <table>
        <tr>
        <th>Id</th><th>Coach Id</th><th>Start Date</th><th>End Date</th><th>Minitus</th>
        </tr>
        <?php echo $payed_rows; ?>
    </table>
    <div>  Pending Payment Details</div>
    <table>
        <tr><td>Total Mini</td><td> <?php echo $WithCoachTotalMin+$WithoutCoachTotalMini;?> </td></tr>
        <tr><td>With Coach</td><td> <?php echo $WithCoachTotal."/=";?> </td></tr>
        <tr><td>Without Coach</td><td> <?php echo $WithoutCoachTotal."/=";?> </td></tr>
        <tr><td>Total</td><td> <?php echo $grandTotal."/=";?> </td></tr>
     
        
    </table>
    <hr>
    <form action="RecivePayment.php" method="post">
        <input type="hidden" value="<?php echo $memberid;?>" name="memberid" />
        
        <input type="submit" value="Receve Payment" />
    </form>
</body>
</html>