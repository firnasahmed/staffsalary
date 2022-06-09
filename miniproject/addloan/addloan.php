<html>
<body>
<?php
		$con = mysqli_connect("localhost","root","","staffmembersinfo");
	if (!$con){
		die('Could not connect:'.mysql_error());
	}
	else
	{
		echo "Congrats! Loan Details Added Successfully ";
		echo nl2br("\n");
			$sql="INSERT INTO loan_deduction(staff_id,loan_amount)
			VALUES
			('$_POST[staff_idin]',
			'$_POST[loan_amountin]')";
}
	if (!mysqli_query($con,$sql))
	{
		echo "";
		die('Error:'.mysqli_error());
		header ("Location: ../addloan/addloan.php");
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
