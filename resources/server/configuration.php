<?php

if(empty($access)) { die(); }

session_start();

$_DATABASEHOST = "YOUR_MYSQL_HOSTNAME";
$_DATABASEUSER = "YOUR_MYSQL_USERNAME";
$_DATABASEPASS = "YOUR_MYSQL_PASSWORD";
$_DATABASENAME = "YOUR_MYSQL_DBNAME";

$dbconnect = mysqli_connect($_DATABASEHOST, $_DATABASEUSER, $_DATABASEPASS, $_DATABASENAME);

function userLoggedin() {
	if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
		return true;
	} else {
		return false;
	}
}

?>