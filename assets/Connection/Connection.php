<?php
$server="localhost";
$username="root";
$password="";
$DB="db_thrift";
$con=mysqli_connect($server,$username,$password,$DB);
if (!$con)
{                        
	echo "error";
}
?>