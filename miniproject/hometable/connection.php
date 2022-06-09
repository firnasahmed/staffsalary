<?php

$con = mysql_connect("localhost","root","","staffmembersinfo");
     if(!$con){
           die("Database Connection failed".mysql_error());
}else{
$db_select = mysql_select_db("testdb_domesticatedbrain", $con);
     if(!$db_select){
           die("Database selection failed".mysql_error());
}else{

   }
}

$records = mysql_query("SELECT * FROM staffmembers");

 

?>