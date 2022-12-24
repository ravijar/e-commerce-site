<?php

$host="localhost";
$dbuser="root";
$dbpwd="";
$db="dbgroup29";

//create connection
$adminconnection=mysqli_connect($host,$dbuser,$dbpwd,$db) ;
//mysql_select_db($db);

//check connection
/*if($adminconection->connect_error){
	die("Connection failed:".$adminconection->connect_error);
}
echo "connected successfully";*/

if(!$adminconnection){
	die(mysqli_error($adminconnection));	
}

?>