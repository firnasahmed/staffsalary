<?php
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "staffmembersinfo";

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the session
//session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
//if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //header("location: welcome.php");
  //  exit;


// Define variables and initialize with empty values
$username_1 = $password_1 = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty($_POST["username"])){
        $username_err = "Please enter username.";
    } else{
        $username_1 = $_POST["username"];
    }
    
    // Check if password is empty
    if(empty($_POST["password"])){
        $password_err = "Please enter your password.";
    } else{
        $password_1 = $_POST["password"];
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM login WHERE username = '$username_1'";
		$result = $conn->query($sql);
        if ($result->num_rows > 0) 
        { 
          // Fetch one and one row
          $total_columns = mysqli_field_count($conn); 
          if($total_columns>0){
            $row=mysqli_fetch_row($result);
            if($password_1==$row[1]){
                session_start();
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
               // $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;                            
                
                // Redirect user to welcome page
                header("location: ../homepage/Home.php");
            }
			else{
                echo "The password you entered was not valid.";
            }
          }

        }else{
            echo "No account found with that username.";
        }
        
    }
}
    
    // Close connection
    $conn->close();
?>