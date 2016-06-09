<?php

if(isset($_POST['submitLogin'])) {

	$confirmChecks = 0;

	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);

	if(empty($username)) {
		$confirmChecks = 1;
	}

	if(empty($password)) {
		$confirmChecks = 1;
	}

	if($confirmChecks == 0) {
		$checkExists = mysqli_query($dbconnect, "SELECT * FROM paneladmin WHERE username = '".mysqli_real_escape_string($dbconnect, $username)."' LIMIT 1");

		if(mysqli_num_rows($checkExists) == 1) {
			$findRow = mysqli_fetch_assoc($checkExists);

			$salt = $findRow['passwordsalt'];
			$password = sha1(crypt($password, $salt));

			$checkLoginSuccess = mysqli_query($dbconnect, "SELECT * FROM paneladmin WHERE username = '".mysqli_real_escape_string($dbconnect, $username)."' AND BINARY password = '".$password."' LIMIT 1");

			if(mysqli_num_rows($checkLoginSuccess) == 1) {
				$getData = mysqli_fetch_assoc($checkLoginSuccess);
				if($getData['banned'] == 2) {
					//user is banned
				} else {
					$_SESSION['userID'] = $getData['userID'];
					$_SESSION['username'] = $getData['username'];
					$_SESSION['level'] = $getData['level'];

					header('location: index.php');
				}
			}

		} else {
			echo "Users dosen't exist";
			header('location: index.php');
		}

	}

}

?>