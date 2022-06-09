<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   // header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id,username,password FROM users WHERE username = '$username'";
        if ($result=mysqli_query($link,$sql)) 
        { 
          // Fetch one and one row
          $total_columns = mysqli_field_count($link); 
          if($total_columns>0){
            $row=mysqli_fetch_row($result);
            if($password==$row[2]){
                session_start();
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;                            
                
                // Redirect user to welcome page
                header("location: Home.php");
            }else{
                $password_err = "The password you entered was not valid.";
            }
          }

        }else{
            $username_err = "No account found with that username.";
        }
        
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/style.css" charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title class="main">Sign in</title>
</head>

<body>

<div class="main">
		<p class="sign" align="center" action="Login.php" method="post">Sign in</p>
		<form  action="Login.php" method="post" class="form1">
               <center> <label>Username</label> </center>
                <input class="un " type="text" name="username"  value="<?php echo $username; ?>"> <br>
                <span ><?php echo $username_err; ?></span>
          
               <center> <label>Password</label> </center>
                <input class="un " type="password" name="password" ><br>
                <span ><?php echo $password_err; ?></span>
            </div>
            <button class="submit" type="submit" align="center">Sign in</button>
			</form>

</body>

</html>