<?php
// Initialize the session
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
require_once "config.php";
//load members data
$query = "SELECT member_id,member_name, member_phonenumber, member_address, member_gender from members"; 
$member_rows="";
if ($result=mysqli_query($link,$query)) 
{ 
  $member_rows="";
  while ($row=mysqli_fetch_row($result)) 
    { 
        $member_rows = $member_rows."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><a href='MemberPayment.php?memberid=".$row[0]."'>Make Payment</a></td><td><a href='SwimmingSchedule.php?memberid=".$row[0]."'>Swimming Schedule</a></td></tr>";
    } 
  mysqli_free_result($result); 
}


$member_name_err="";
$member_phonenumber_err="";
$member_address_err="";
$member_gender_err="";

$member_name="";
$member_phonenumber="";
$member_address="";
$member_gender="";
$sucessmsg="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["member_name"])){
        $member_name_err = "Please enter member_name.";
    } else{
        $member_name = trim($_POST["member_name"]);
    }
    if(empty($_POST["member_phonenumber"])){
        $member_phonenumber_err = "Please enter member_phonenumber.";
    } else{
        $member_phonenumber = trim($_POST["member_phonenumber"]);
    }
    if(empty($_POST["member_address"])){
        $member_address_err = "Please enter member_address.";
    } else{
        $member_address = trim($_POST["member_address"]);
    }
    if(empty($_POST["member_gender"])){
        $member_gender_err = "Please enter member_gender.";
    } else{
        $member_gender = trim($_POST["member_gender"]);
    }
    if(empty($member_name_err) && empty($member_phonenumber_err)&& empty($member_address_err)&& empty($member_gender_err)){
          $query ="INSERT INTO members (member_name, member_phonenumber, member_address, member_gender) VALUES ('$member_name', '$member_phonenumber', '$member_address', '$member_gender')";
          if (mysqli_query($link, $query)) {      
                $member_name="";
                $member_phonenumber ="";
                $member_address="";
                $member_gender="";
                $sucessmsg= "Inserted successfully "; 

                $query = "SELECT member_id,member_name, member_phonenumber, member_address, member_gender from members"; 
                $member_rows="";
                if ($result=mysqli_query($link,$query)) 
                { 
                    while ($row=mysqli_fetch_row($result)) 
                    { 
                        $member_rows = $member_rows."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><a href='MemberPayment.php?memberid=".$row[0]."'>Make Payment</a></td></tr>";
                    } 
                    mysqli_free_result($result); 
                }
            } else {
                $sucessmsg= "Error: " . $query . "<br>" . mysqli_error($link);
            }   
        
    }
}
mysqli_close($link); 
?>
 
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css" charset="UTF-8">
    <link rel="stylesheet" href="css/table.css" charset="UTF-8">
    <title>home</title>
</head>
<body>
    <div class="page-header">
	<h1></b>Sign Up - Member</h1>
			<br></br>
    <a class="homebuttons" href="Home.php">Home</a><br>
	<br></br>
    </div>
    <div>
    <?php echo $sucessmsg;?>
    </div>
    <form class="form1" action="MemberRegistration.php" method="post">
        Name <pre></pre>
        <input type="text" name="member_name" value="<?php echo $member_name; ?>"/>  <span><?php echo $member_name_err; ?></span> <br>
        Phonenumber 
        <input type="text" name="member_phonenumber" value="<?php echo $member_phonenumber; ?>" /> <span><?php echo $member_phonenumber_err; ?></span><br>
        Gender 
        <input type="radio" name="member_gender" value="Male" checked /> Male <pre></pre>
        <input type="radio" name="member_gender" value="Femal"/> Female 
		<br></br>
        Address <br>
        <input type="text" name="member_address" value="<?php echo $member_address; ?>" /> <span><?php echo $member_address_err; ?></span><br>
       <br></br>
	   <input class="homebuttons" type="submit" value="Save" />
    </form>

    <hr>
    <table class="pass" border="1">
        <tr>
        <th>Id</th><th>Name</th><th>Phone</th><th>Address</th><th>Gender</th>
        </tr>
        <?php echo $member_rows; ?>
    </table>
</body>
</html>