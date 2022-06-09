<?php
// Initialize the session
session_start();
require_once "config.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$memberid="";
if(empty($_GET["memberid"]) ){
    if(empty($_POST["memberid"])){
        header("location: MemberRegistration.php");
        exit;
    }else{
        $memberid=$_POST["memberid"];
    }
   
} else{
    $memberid=$_GET["memberid"];
}
$query = "SELECT id,member_id, coach_id, start_date, end_date, total_hours from swimmingschedule WHERE member_id='$memberid'"; 
$schedule_rows="";
if ($result=mysqli_query($link,$query)) 
{ 
    while ($row=mysqli_fetch_row($result)) 
    { 
        $schedule_rows = $schedule_rows."<tr><td>".$row[0]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><a href='DeleteSwimmingSchedule.php?sid=".$row[0]."&memberid=".$row[1]."'>Delete</a></td></tr>";
    } 
    mysqli_free_result($result); 
}

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

$error="";
if($_SERVER["REQUEST_METHOD"] == "POST"){

        $memberid = trim($_POST["memberid"]);
        $coachid = trim($_POST["coachid"]);

        $startdate_day = trim($_POST["startdate_day"]);
        $startdate_month = trim($_POST["startdate_month"]);
        $startdate_year = trim($_POST["startdate_year"]);
        $startdate_hour = trim($_POST["startdate_hour"]);
        $startdate_min = trim($_POST["startdate_min"]);

        $endtdate_day = trim($_POST["endtdate_day"]);
        $endtdate_month = trim($_POST["endtdate_month"]);
        $endtdate_year = trim($_POST["endtdate_year"]);
        $endtdate_hour = trim($_POST["endtdate_hour"]);
        $endtdate_min = trim($_POST["endtdate_min"]);
        if($startdate_day<10){$startdate_day="0".$startdate_day;}
        if($startdate_month<10){$startdate_month="0".$startdate_month;}
        if($startdate_hour<10){$startdate_hour="0".$startdate_hour;}
        if($startdate_min<10){$startdate_min="0".$startdate_min;}

        if($endtdate_day<10){$endtdate_day="0".$endtdate_day;}
        if($endtdate_month<10){$endtdate_month="0".$endtdate_month;}
        if($endtdate_hour<10){$endtdate_hour="0".$endtdate_hour;}
        if($endtdate_min<10){$endtdate_min="0".$endtdate_min;}

        $start_date_raw=$startdate_year.'-'.$startdate_month.'-'.$startdate_day.' '.$startdate_hour.':'.$startdate_min.":00";
        $end_date_raw=$endtdate_year.'-'.$endtdate_month.'-'.$endtdate_day.' '.$endtdate_hour.':'.$endtdate_min.":00";
        $start_date = date_create_from_format('Y-m-d H:i:s',$start_date_raw);
        $end_date = date_create_from_format('Y-m-d H:i:s',$end_date_raw);
        if($end_date>$start_date){
            $interval = abs(strtotime($end_date_raw) - strtotime($start_date_raw));
            $minutes  = round($interval / 60);
            $error= $minutes; 
            
            $query="INSERT INTO swimmingschedule(member_id, coach_id, start_date, end_date, total_hours) VALUES ($memberid,$coachid,'$start_date_raw','$end_date_raw',$minutes)";
            if (mysqli_query($link, $query)) {      
              
                $error= "Inserted successfully "; 
                $query = "SELECT id,member_id, coach_id, start_date, end_date, total_hours from swimmingschedule WHERE member_id='$memberid'"; 
                $schedule_rows="";
                if ($result=mysqli_query($link,$query)) 
                { 
                    while ($row=mysqli_fetch_row($result)) 
                    { 
                        $schedule_rows = $schedule_rows."<tr><td>".$row[0]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><a href='DeleteSwimmingSchedule.php?id=".$row[0]."'>Delete</a></td></tr>";
                    } 
                    mysqli_free_result($result); 
                }
               
            } else {
                $error= "Error: " . $query . "<br>" . mysqli_error($link);
            }   
        }else{
            $error="Date";
        }
}

$coach_rows="";
$query = "SELECT coach_id,coach_name  from coach"; 
if ($result=mysqli_query($link,$query)) 
{ 
    while ($row=mysqli_fetch_row($result)) 
    { 
        $selected="";
        if(!empty($coachid)){
            if($row[0]==$coachid){
                $selected="selected";
            }
        }
        $coach_rows = $coach_rows."<option value='".$row[0]."' ".$selected.">".$row[1]."</option>";
    } 
    mysqli_free_result($result); 
}
?>
  <!DOCTYPE html>
<html>
<head>
    <title>home</title>
</head>
<body>
    <div class="page-header">
    <a href="Home.php">Home</a><br>
    </div>
    <div>
    <div>Member Details</div>
    <table border="1">
        <tr><td>Id</td><td> <?php echo $memberid;?> </td></tr>
        <tr><td>Name</td><td> <?php echo $member_name;?> </td></tr>
        <tr><td>Phone</td><td> <?php echo $member_phonenumber;?> </td></tr>
        <tr><td>Address</td><td> <?php echo $member_address;?> </td></tr>
        <tr><td>Gender</td><td> <?php echo $member_gender;?> </td></tr>
        
    </table>
    <?php echo $error; ?>
    </div>
    <hr>
    <form action="SwimmingSchedule.php" method="post">
    <input name="memberid" type="hidden" value="<?php echo $memberid; ?>" />
      <table border="1">
            <tr>
                <td>Select Coach</td>
                <td>
                <select name="coachid">
                <option value="0">No Coach</option>
                <?php echo $coach_rows; ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>Start Date Time</td>
                <td>
                Day
                <select name="startdate_day">
                <?php 
                    for ($x = 1; $x <= 31; $x++) {
                        $selected="";
                        if(!empty($startdate_day)){
                            if($x==$startdate_day){
                                $selected="selected";
                            }
                        }
  
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>
                Month
                <select name="startdate_month">
                <?php 
                    for ($x = 1; $x <= 12; $x++) {
                        $selected="";
                        if(!empty($startdate_month)){
                            if($x==$startdate_month){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>
                Year
                <select name="startdate_year">
               
                <?php 
                    for ($x = 2020; $x <= 2030; $x++) {
                        $selected="";
                        if(!empty($startdate_year)){
                            if($x==$startdate_year){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                   
                </select>
                Hour
                <select name="startdate_hour">
                <?php 
                    for ($x = 1; $x <= 24; $x++) {
                        $selected="";
                        if(!empty($startdate_hour)){
                            if($x==$startdate_hour){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>
                Minits
                <select name="startdate_min">
               
                <?php 
                    for ($x = 0; $x <= 59; $x++) {
                        $selected="";
                        if(!empty($startdate_min)){
                            if($x==$startdate_min){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                  
                </select>
                </td>
            </tr>
            <tr>
                <td>End Date time</td>
                <td>
                Day
                <select name="endtdate_day">
                <?php 
                    for ($x = 1; $x <= 31; $x++) {
                        $selected="";
                        if(!empty($endtdate_day)){
                            if($x==$endtdate_day){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>
                Month
                <select name="endtdate_month">
                <?php 
                    for ($x = 1; $x <= 12; $x++) {
                        $selected="";
                        if(!empty($endtdate_month)){
                            if($x==$endtdate_month){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>
                Year
                <select name="endtdate_year">
               
                <?php 
                    for ($x = 2020; $x <= 2030; $x++) {
                        $selected="";
                        if(!empty($endtdate_year)){
                            if($x==$endtdate_year){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                   
                </select>
                Hour
                <select name="endtdate_hour">
                <?php 
                    for ($x = 1; $x <= 24; $x++) {
                        $selected="";
                        if(!empty($endtdate_hour)){
                            if($x==$endtdate_hour){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                </select>
                Minits
                <select name="endtdate_min">
                <?php 
                    for ($x = 0; $x <= 59; $x++) {
                        $selected="";
                        if(!empty($endtdate_min)){
                            if($x==$endtdate_min){
                                $selected="selected";
                            }
                        }
                       echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
                    }
                ?>
                  
                </select>
                </td>
            </tr>


      </table>
      <input type="submit" value="Submit"/>
    </form>

   
    <hr>
    <table border="1">
        <tr>
        <th>Id</th><th>Coach Id</th><th>Start Date</th><th>End Date</th><th>Minitus</th><th></th>
        </tr>
        <?php echo $schedule_rows; ?>
    </table>
</body>
</html>