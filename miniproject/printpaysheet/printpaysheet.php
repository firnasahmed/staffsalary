

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
  background-color: #2196F3;
  color: black;
}

.active {
background-color: #2196F3;
 color: white;
}

.active22 {
background-color: green;
 color: black;
 width: 20%;
 font-family: Arial;
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
 font-family: Arial;
}

* {
  box-sizing: border-box;
}

input[type=text] {
  width: 200px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
input[type=text]:focus {
  width: 100%;
}

#html-2-pdfwrapper {
      position: absolute; 
      left: 20px; 
      top: 50px; 
      bottom: 0; 
      overflow: auto; 
      width: 600px;

    
</style>
</head>
<body>

<div class="topnav">
  <a href = 'http://localhost/miniproject/homepage';>Home</a>
  <a href="#about">About</a>
</div>

<center>
<div style="padding-left:16px">
  <h1>Bright Light Internation School - Staffs</h1>
  <h2>Financial Details</h2>
</div>
</center>

<center>

<form action="printpaysheet.php">
  <input type="text" name="search" placeholder="Search Staff..">
</form>
</center>
<br></br>
 <div>
       <a> Month</a>
                <select class="loanded" name="month">
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

              <a>  Year</a>
                <select class="loanded" name="year">
               
                <?php 
                    for ($x = 2018; $x <= 2030; $x++) {
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
				<button class="addstaff"> Go </button>
        </div>
		<br></br>


  
  
<table border="2">

  <tr>
    <th>Month No</th>
    <th>Month </th>
    <th>Total Basic Salary</th>
    <th>Total Over Time</th>
	<th>Total Festival Advance</th>
    <th>Total Loan Deduction</th>
  </tr>
<br></br>
  <tr>
    <td> 6 </td>
    <td>June</td>
    <td>130000/=</td>
	<td>10000/=</td>
	<td>120000/=</td>
	<td>50000/=</td>
  </tr>

  </table>
  
  <table border="2">

  <tr>
    <th>Total Income for the selected month</th>
    <th>Total Expenses for the selected month </th>
	<th>Net Balance </th>
    
  </tr>
<br></br>
  <tr>
    <td> 522000/= </td>
    <td>310000/=</td>
	<td>212000/=</td>

  </tr>

  </table>

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
$staffmembers_rows="";

$sql = "SELECT a.staff_id, a.staff_name, a.basic_salary, 
		b.amount overtime, c.fa_amount festival_advance, d.loan_amount loan_deduction
FROM staffmembers a
LEFT JOIN overtime b ON a.staff_id = b.staff_id
JOIN festival_advance c ON a.staff_id = c.staff_id
LEFT JOIN loan_deduction d ON a.staff_id = d.staff_id";
 $result = $conn->query($sql);

 echo "<br>";
 echo "<br>";
 echo "<br>";
 
 if ($result->num_rows > 0) {
	echo "<table><tr><th>Staff ID</th><th>Staff Name</th><th>Basic Salary</th><th>Over Time</th><th>Festival Advance</th><th>Loan Deduction</th></tr>";
 
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
        echo "<td>" . $row["staff_id"] . "</td><td>" . $row["staff_name"] . "</td><td>" . $row["basic_salary"] . "/=</td><td>" . $row["overtime"] . "/=</td><td>" . $row["festival_advance"] . "/=</td><td>" . $row["loan_deduction"] ."/="."</td>";
		echo "</tr>";
    }
	
	echo "</table>";
 } else {
     echo "0 results";
 }

$result = $conn->query($sql);
echo "<br>";
echo "<br>";
echo "<br>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo $row["staff_id"] . " " . $row["staff_name"]. "		 " . $row["fa_amount"]."<br>";
	
    }
} else {
    //echo "Error: ".$sql."<br>".mysqli_error($conn);
}
echo "<br>";


$conn->close();
?>
  
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
<input class="btn paysheet" type="button" onClick="window.print()" value="Print Document" />
<br></br>
	
</center>
  
</body>
</html>
