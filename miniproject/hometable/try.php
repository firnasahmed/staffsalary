<?php
	include_once('connection.php');
	$query="SELECT * FROM staffmembers";
	$result=mysql_query($query);
?>

<!DOCTYPE html>
<html>
	<title>
		<head> Staff Members Details </head>
	</title>
<body>
<table align="center" border=1px style="width:300px; line-height:30">
  <tr>
    <th colspan="8">Staffs Details</th>
  </tr>

  <t>
    <th>Satff ID</th>
    <th>Satff Name</th>
    <th>Gender</th>
	<th>Address</th>
	<th>Email</th>
	<th>Phone Number</th>
	<th>Date Of Birth</th>
	<th>Basic salary</th>
  </t>
  

</table>
</body>
</html>