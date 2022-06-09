<html>
<body>
<?php
		$con = mysqli_connect("localhost","root","","staffmembersinfo");
	if (!$con){
		die('Could not connect:'.mysql_error());
	}
	else
	{
		echo "Congrats! connection established successfully ";
		echo nl2br("\n");
			$sql="INSERT INTO staffmembers (staff_id,staff_name,gender,address,email,phone_no,dob,basic_salary)
			VALUES
			('$_POST[staff_idin]',
			'$_POST[staff_namein]',
			'$_POST[genderin]',
			'$_POST[addressin]',
			'$_POST[emailin]',
			'$_POST[phone_noin]',
			'$_POST[dobin]',
			'$_POST[basic_salaryin]')";
}
	if (!mysqli_query($con,$sql))
	{
		echo "";
		die('Error:'.mysqli_error());
		header ("Location: ../addstaff/addstaff.php");
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
