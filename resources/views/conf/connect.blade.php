<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "nonongs_db";
$con = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

if(!$con)
{
	die("ERROR: Failed to connect to MySQL!" . mysqli_connect_error());
}
