<html>
<body>
<?php
		$con = mysqli_connect("localhost","root","","staffmembersinfo");
	if (!$con){
		die('Could not connect:'.mysql_error());
	}
	else
	{
		echo "Congrats! OT Added Successfully ";
		echo nl2br("\n");
			$sql="INSERT INTO overtime(staff_id,amount,rate,month)
			VALUES
			('$_POST[staff_idin]',
			'$_POST[amountin]',
			'$_POST[ratein]',
			'$_POST[monthin]')";
}
	if (!mysqli_query($con,$sql))
	{
		echo "";
		die('Error:'.mysqli_error());
		header ("Location: ../addot/addot.php");
	}
	else
	{
		echo "1 record Added";
		
		header ("Location: ../homepage/home.php");
	}
	mysqli_close($con);
?>
</body>
</html>
