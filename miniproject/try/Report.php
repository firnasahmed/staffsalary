<?php
// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$month=0;
$year=0;
$error_month="";
$error_year="";

$WithCoach=15;
$WithoutCoach=10;

$WithCoachTotalMin=0;
$WithCoachTotal=0;
$WithoutCoachTotalMini=0;
$WithoutCoachTotal=0;
$grandTotal=0;
$pay_rows="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["month"])){
        $error_month = "invlaid month.";
    } else{
        $month = trim($_POST["month"]);     
    }
    if(empty($_POST["year"])){
        $error_year = "invlaid year.";
    } else{
        $year = trim($_POST["year"]);      
    }
    $startDate=$year."-".$month."-01";
    $endDate=$year."-".$month."-30";
    if(empty($error_month) && empty($error_year)){
        $query = "SELECT id,member_id, coach_id, start_date, end_date, total_hours,Piad_Date from swimmingschedule WHERE IsPaid=1 AND Piad_Date BETWEEN '$startDate' AND '$endDate'"; 
       
        if ($result=mysqli_query($link,$query)) 
        { 
             while ($row=mysqli_fetch_row($result)) 
            { 
                $tmin=$row[5];
                $tot=0;
                if($row[2]==0){
                    $WithoutCoachTotalMini=$WithoutCoachTotalMini+$row[5];
                    $tot=$tmin*$WithoutCoach;
                  }else{
                    $WithCoachTotalMin=$WithCoachTotalMin+$row[5];
                    $tot=$tmin*$WithCoach;
                  }
                $pay_rows = $pay_rows."<tr><td>".$row[6]."</td><td>".$row[1]."</td><td>".$tot."</td></tr>";
               
            } 
            $WithCoachTotal=$WithCoach*$WithCoachTotalMin;
    $WithoutCoachTotal=$WithoutCoach*$WithoutCoachTotalMini;
    $grandTotal=$WithCoachTotal+$WithoutCoachTotal;
            mysqli_free_result($result); 
        }else{
            $error_month = "Error: " . $query . "<br>" . mysqli_error($link);
        }
    }

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Report</title>
    
    
</head>
  <link rel="stylesheet" href="css/style.css" charset="UTF-8">
    <link rel="stylesheet" href="css/table.css" charset="UTF-8">
<body>

    <div class="page-header">
        <h1></b>Financial Site</h1>
    </div>
	<br></br>
    <a class="homebuttons" href="Home.php">Home</a>
    <form class="form1" action="Report.php"  method="post">
    <div>
    <?php echo $error_month;?> <br>
    <?php echo $error_year;?> <br>
    </div>
        <div>
        Month
                <select class="pass" name="month">
                <?php 
                    for ($x = 1; $x <= 12; $x++) {
                        $selected="";
                        if(!empty($month)){
                            if($x==$month){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>

                Year
                <select class="pass" name="year">
               
                <?php 
                    for ($x = 2020; $x <= 2030; $x++) {
                        $selected="";
                        if(!empty($year)){
                            if($x==$year){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                   
                </select>
        </div>
        <input class="homebuttons" type="submit" value="Get Report" />
		<br></br>
    </form>
    <hr>
    <div>   Payment Details</div>
    <table class="pass" border="1">
        <tr><td>Total Mini</td><td> <?php echo $WithCoachTotalMin+$WithoutCoachTotalMini;?> </td></tr>
        <tr><td>With Coach</td><td> <?php echo $WithCoachTotal."/=";?> </td></tr>
        <tr><td>Without Coach</td><td> <?php echo $WithoutCoachTotal."/=";?> </td></tr>
        <tr><td>Total</td><td> <?php echo $grandTotal."/=";?> </td></tr>
     
        
    </table>
    <hr>
    <table class="pass" border="1">
        <tr>
        <th>Paid Date</th><th>Member Id</th><th>Total</th>
        </tr>
        <?php echo $pay_rows; ?>
    </table>
</body>
</html>