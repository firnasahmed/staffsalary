

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

// .topnav a.active {
  // background-color: #2196F3;
  // color: white;
// }

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
<p>Search Staffs:</p>
<form action="printpaysheet.php">
  <input type="text" name="search" placeholder="Search Staff..">
</form>
</center>

<table>
<form>
<div>
<fieldset>
<form>
<div>

<tbody>
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
                          while($row = $result->fetch_assoc())
                          {
                            $staff_name   = $row['staff_name'];
							$staff_id   = $row['staff_id'];
							$basic_salary   = $row['basic_salary'];
							//echo $row["staff_id"];
                          }
						  
						  

                          $sql = "SELECT * from festival_advance";
                          while($row = $result->fetch_assoc())
                          {
                            $fa_amount   = $row['fa_amount'];
                          }
						  

                          $sql = "SELECT * from loan_deduction";

                          while($row = $result->fetch_assoc())
                          {
							$loan_amount  = $row['loan_amount'];
						  
						  
                            $staff_name          = $row['$staff_name'];
                            $staff_id         = $row['staff_id'];
                            $fa_amount       = $row['fa_amount'];
                            

                            //$over     = $row['overtime'] * $rate;
                           // $bonus     = $row['bonus'];
                            $loan_amount  = $row['loan_amount'];
                            $income   = $fa_amount + $basic_salary;
                            $netpay   = $income - $loan_amount;
							
							
							
                        ?>
						<tr class="table">
                          <th><p align="center">Name</p></th>
                          <th><p align="center">Festival Advance</p></th>
						  <th><p align="center">Loan Amount</p></th>
                          <th><p align="center">Basic salary</p></th>
                          <!-- <th><p align="center">Bonus</p></th> -->
                          <th><p align="center">Net Pay</p></th>
                        </tr>
						
                        <tr>
                          <td align="right"><big><b><?php echo $staff_name?></b></big>.00</td>
                          <td align="center"><big><b><?php echo $fa_amount?></b></big>.00</td>
                          <!-- <td align="center"><big><b><?php //echo $overtime?></b></big> hrs</td> -->
                          <td align="center"><big><b><?php echo $loan_amount?></b></big>.00</td>
						  <td align="center"><big><b><?php echo $basic_salary?></b></big>.00</td>
                          <td align="center"><big><b><?php echo $netpay?></b></big>.00</td>
                        </tr>
                    
                      </tbody>

                        

</table>
</form>
</div>
</fieldset>
</form>
</div>
 
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
<button class="btn paysheet" onclick="window.location.href = '#link';">Export as PDF</button>
</center>
</body>
</html>