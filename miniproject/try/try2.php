

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #4CAF50;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

.btn {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
}

/* Green */
.addstaff {
  border-color: #4CAF50;
  color: green;
}

.addstaff:hover {
  background-color: #4CAF50;
  color: white;
}

/* Blue */
.addot {
  border-color: #2196F3;
  color: dodgerblue;
}

.addot:hover {
  background: #2196F3;
  color: white;
}

/* Orange */
.festivaladvance {
  border-color: #ff9800;
  color: orange;
}

.festivaladvance:hover {
  background: #ff9800;
  color: white;
}

/* Red */
.loanded {
  border-color: #f44336;
  color: red;
}

.loanded:hover {
  background: #f44336;
  color: white;
}

/* Pay sheet */
.paysheet {
  border-color: black;
  color: black;
}

.paysheet:hover {
  background: black;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" onclick="window.location.href = 'http://localhost/miniproject/homepage';">Home</a>
  <a href="#about">About</a>
</div>

<div style="padding-left:16px">
  <h2>Top Navigation Example</h2>
  <p>Some content..</p>
</div>

<button class="btn addstaff" onclick="window.location.href = 'http://localhost/miniproject/addstaff/addstaff.html';">Add New Staff</button>
<button class="btn addot" onclick="window.location.href = 'http://localhost/miniproject/addot/addot.html';">Add OT</button>
<button class="btn festivaladvance" onclick="window.location.href = 'http://localhost/miniproject/addfes/addfes.html';">Add Festival Advance</button>
<button class="btn loanded" onclick="window.location.href = 'http://localhost/miniproject/addloan/addloan.html';">Add Loan Details</button>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "staffmembersinfo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//load staff members data
$query = "SELECT staff_id,staff_name,phone_no,address,basic_salary from staffmembers"; 
$member_rows="";
if ($result=mysqli_query($conn,$query)) 
{ 
  $member_rows="";
  while ($row=mysqli_fetch_row($result)) 
    { 
        $member_rows = $member_rows."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><a href='#link".$row[0]."'>Make Payment</a></td><td><a href='#link".$row[0]."'>Swimming Schedule</a></td></tr>";
    } 
  mysqli_free_result($result); 
}


$staff_id_err="";
$staff_name_err="";
$phone_no_err="";
$address_err="";

$staff_id="";
$staff_name="";
$phone_no="";
$address="";
$sucessmsg="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["staff_id"])){
        $staff_id_err = "Please enter staff_id.";
    } else{
        $staff_id = trim($_POST["staff_id"]);
    }
    if(empty($_POST["staff_name"])){
        $staff_name_err = "Please enter staff_name.";
    } else{
        $staff_name = trim($_POST["staff_name"]);
    }
    if(empty($_POST["phone_no"])){
        $phone_no_err = "Please enter phone_no.";
    } else{
        $phone_no = trim($_POST["phone_no"]);
    }
    if(empty($_POST["address"])){
        $address_err = "Please enter address.";
    } else{
        $address = trim($_POST["address"]);
    }
    if(empty($staff_id_err) && empty($staff_name_err)&& empty($phone_no_err)&& empty($address_err)){
          $query ="INSERT INTOstaffmembers (staff_id, staff_name, phone_no, address) VALUES ('$staff_id', '$staff_name', '$phone_no', '$address')";
          if (mysqli_query($conn, $query)) {      
                $staff_id="";
                $staff_name ="";
                $phone_no="";
                $address="";
                $sucessmsg= "Inserted successfully "; 

                $query = "SELECT member_id,staff_id, staff_name, phone_no, address from staffmembers"; 
                $member_rows="";
                if ($result=mysqli_query($conn,$query)) 
                { 
                    while ($row=mysqli_fetch_row($result)) 
                    { 
                        $member_rows = $member_rows."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><a href='MemberPayment.php?memberid=".$row[0]."'>Make Payment</a></td></tr>";
                    } 
                    mysqli_free_result($result); 
                }
            } else {
                $sucessmsg= "Error: " . $query . "<br>" . mysqli_error($conn);
            }   
        
    }
}
mysqli_close($conn); 
?>
  
</table>





<script>
// Get the modal
var modal = document.getElementById('addstaff1');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<button class="btn paysheet" onclick="window.location.href = 'http://localhost/miniproject/printpaysheet/printpaysheet.php';">Print Pay Sheet</button>

  
</body>
</html>





