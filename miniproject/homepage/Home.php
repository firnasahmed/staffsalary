

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

.logout {
  float: right;
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
  <button class="logout" onclick="window.location.href = 'http://localhost/miniproject/logwindow/Log%20Window%202.html';">Log Out</button>
</div>



<center>
<div style="padding-left:16px">
  <h2>Welcome to Bright Light International School</h2>
  <p>Salary System</p>
</div>


<button class="btn addstaff" onclick="window.location.href = 'http://localhost/miniproject/addstaff/addstaff.html';">Add New Staff</button>
<button class="btn addot" onclick="window.location.href = 'http://localhost/miniproject/addot/addot.html';">Add OT</button>
<button class="btn festivaladvance" onclick="window.location.href = 'http://localhost/miniproject/addfes/addfes.html';">Add Festival Advance</button>
<button class="btn loanded" onclick="window.location.href = 'http://localhost/miniproject/addloan/addloan.html';">Add Loan Details</button>
</center>


<center>
<table border="1">



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

$sql = "SELECT * FROM staffmembers";
 $result = $conn->query($sql);

 echo "<br>";
 echo "<br>";
 echo "<br>";
 
 if ($result->num_rows > 0) {
	echo "<table><tr><th>Staff ID</th><th>Staff Name</th><th>Gender</th><th>Address</th><th>Email</th><th>Phone No.</th><th>Basic Salary</th></tr>";
 
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
        echo "<td>" . $row["staff_id"] . "</td><td>" . $row["staff_name"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["address"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone_no"] . "</td><td>" . $row["basic_salary"] ."</td>";
		echo "</tr>";
    }
	
	echo "</table>";
 } else {
     echo "0 results";
 }
 echo "<br>";
 echo "<br>";
 echo "<br>";
 
 
$conn->close();
?>
</center>


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


<center>
<button class="btn paysheet" onclick="window.location.href = 'http://localhost/miniproject/printpaysheet/printpaysheet.php';">Print Pay Sheet</button>
</center>
  
</body>
</html>