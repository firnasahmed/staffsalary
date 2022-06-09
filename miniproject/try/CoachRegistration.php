<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
require_once "config.php";

$member_rows="";
$query = "SELECT coach_id,coach_name, coach_phonenumber, coach_address, coach_email from coach"; 
if ($result=mysqli_query($link,$query)) 
{ 
  while ($row=mysqli_fetch_row($result)) 
    { 
        $member_rows = $member_rows."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
    } 
    mysqli_free_result($result); 
}

$coach_name_err="";
$coach_phonenumber_err="";
$coach_address_err="";
$coach_email_err="";

$coach_name="";
$coach_phonenumber="";
$coach_address="";
$coach_email="";
$sucessmsg="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["coach_name"])){
        $coach_name_err = "Please enter coach_name.";
    } else{
        $coach_name = trim($_POST["coach_name"]);
    }
    if(empty($_POST["coach_phonenumber"])){
        $coach_phonenumber_err = "Please enter coach_phonenumber.";
    } else{
        $coach_phonenumber = trim($_POST["coach_phonenumber"]);
    }
    if(empty($_POST["coach_address"])){
        $coach_address_err = "Please enter coach_address.";
    } else{
        $coach_address = trim($_POST["coach_address"]);
    }
    if(empty($_POST["coach_email"])){
        $coach_email_err = "Please enter coach_email.";
    } else{
        $coach_email = trim($_POST["coach_email"]);
    }
    if(empty($coach_name_err) && empty($coach_phonenumber_err)&& empty($coach_address_err)&& empty($coach_gender_err)&& empty($coach_email_err)){
        $query ="INSERT INTO coach (coach_name, coach_phonenumber, coach_address, coach_email) VALUES ('$coach_name', '$coach_phonenumber', '$coach_address', '$coach_email')";
        if (mysqli_query($link, $query)) {      
            $coach_name="";
            $coach_phonenumber="";
            $coach_address="";
            $coach_email="";
           $sucessmsg= "Inserted successfully "; 

           
           $member_rows="";
           $query = "SELECT coach_id,coach_name, coach_phonenumber, coach_address, coach_email from coach"; 
           if ($result=mysqli_query($link,$query)) 
           { 
             while ($row=mysqli_fetch_row($result)) 
               { 
                   $member_rows = $member_rows."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
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
	<h1></b>Sign Up - Coach</h1>
		<br></br>
    <a class="homebuttons" href="Home.php">Home</a><br>
	<br></br>
    </div>
    <div>
    <?php echo $sucessmsg;?>
    </div>
    <form class="form1" action="coachRegistration.php" method="post">
        Name <br>
        <input type="text" name="coach_name" value="<?php echo $coach_name; ?>"/>  <span><?php echo $coach_name_err; ?></span> <br>
        Phonenumber <br>
        <input type="text" name="coach_phonenumber" value="<?php echo $coach_phonenumber; ?>" /> <span><?php echo $coach_phonenumber_err; ?></span><br>
        Email <br>
        <input type="text" name="coach_email" value="<?php echo $coach_email; ?>" /> <span><?php echo $coach_email_err; ?></span><br>
        Address <br>
        <input type="text" name="coach_address" value="<?php echo $coach_address; ?>" /> <span><?php echo $coach_address_err; ?></span><br>
        <input class="homebuttons" type="submit" value="Save" />
    </form>
    <hr>
    <table class="pass" border="1">
        <tr>
        <th>Id</th><th>Name</th><th>Phone</th><th>Address</th><th>Email</th>
        </tr>
        <?php echo $member_rows; ?>
    </table>
</body>
</html>