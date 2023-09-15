<?php

$host="localhost";
$dbuser="root";
$dbpwd="";
$db="ecommerce-db";
//create connection
$adminconnection=mysqli_connect($host,$dbuser,$dbpwd,$db) ;
//mysql_select_db($db);

//check connection
/* if($adminconection->connect_error){
	die("Connection failed:".$adminconection->connect_error);
}
echo "connected successfully"; */

if(!$adminconnection){
	echo "error";
	die(mysqli_error($adminconnection));	
} 
?>