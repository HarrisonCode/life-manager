<?php
$access = 1;
require('resources/server/configuration.php');

$error1 = 0;
$error2 = 0;
	if(isset($_POST['createAccount'])) {
		$validateSuccess = 0;

		$regUsername = strip_tags($_POST['regUsername']);
		$regPassword = strip_tags($_POST['regPassword']);

		if(empty($regUsername)) {
			$validateSuccess = 1;
			$error1 = 1;
		}

		if(empty($regPassword)) {
			$validateSuccess = 1;
			$error2 = 1;
		}

		if($validateSuccess == 0) {
			$salt = uniqid('', true);
			$regPassword = sha1(crypt($regPassword, $salt));
			mysqli_query($dbconnect, "INSERT INTO paneladmin VALUES ('', '".$regUsername."', '".$regPassword."', '".$salt."', '3', '1')");
		}
	}

?>

<!-- SITE AUTHOR: HarrisonLewis.Design -->

<!DOCTYPE html>
<html>
<head>
  <title></title>

  <!-- Import Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="resources/client/css/font-awesome.min.css">
  <link rel="stylesheet" href="resources/client/css/animate.css">
  <link rel="stylesheet" href="resources/client/css/default.css">
  <link rel="stylesheet" href="resources/client/css/theme.css">

</head>
<body>
<div style="background-color: #e85647; color: white; width: 100%; padding: 15px; font-size: 75px; text-align: center;">
DELETE FILE ONCE FINISHED
<small style="display: block; font-size: 10px;">must delete file name: install.php</small>
</div>
<h1 style="text-align: center; color: #3F292B; width: 25%; background-color: #DB7F67; padding: 10px; margin: 0 auto; margin-top: 10px; margin-bottom: 10px;">INSTALLATION PAGE</h1>

<div style="background-color: #e85647; color: white; width: 50%; padding: 5px; margin: 0 auto;">
	Please edit the file resources/server/configuration.php 's Database login Credentials to fit your databases.
	Make sure you've executed the SQL inside your database, If you've done this ignore this message.
</div>

<div style="background-color: #2ecc71; color: white; width: 50%; padding: 5px; margin: 0 auto;">
	Create a LEVEL 3 *highest* Admin Account.
	<small>You will beable to make more account on the dashboard.</small>
</div>
	<?php
		if($error1 == 1) {
			echo "<h3 style='color: #424242; text-align: center;'>Invalid Username</h3>";
		}
		if($error2 == 1) {
			echo "<h3 style='color: #424242; text-align: center;'>Invalid Password</h3>";
		}
	?>
	<p style="color: #424242; font-size: 15px; text-align: center;">Make sure your username and password contain only letters and numbers.</p>
<form action="install.php" method="post" style="text-align: center;">
	<div style="display: block; margin-top: 10px;"><span style="font-size: 25px; padding-right: 10px;">Username:</span> <input type="text" name="regUsername" style="border: 0; border-bottom: 1px solid #424242; font-size: 25px;"></div>
	<div style="display: block; margin-top: 10px;"><span style="font-size: 25px; padding-right: 10px;">Password:</span><input type="password" name="regPassword" style="border: 0; border-bottom: 1px solid #424242; font-size: 25px;"></div>
	<div style="display: block; margin-top: 10px;"><input type="submit" name="createAccount" style="background-color: #424242; color: white; padding: 15px; border: 0; font-size: 20px;" value="Create Account"></div>
</form>

<p>

</body>
</html>
