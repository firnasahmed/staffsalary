<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","studensinfo");
if (!$con){
die('Could not connect:'.mysql_error());
}
else
{
echo "Congrats! connection established successfully ";
echo nl2br("\n");
$sql="INSERT INTO student (st_id,st_name)
VALUES
('$_POST[st_idin]',
'$_POST[st_namein]')";
}
if (!mysqli_query($con,$sql))
{
echo "";
die('Error:'.mysqli_error());
}
else
{
echo "1 record added";
}
mysqli_close($con);
?>
</body>
</html>