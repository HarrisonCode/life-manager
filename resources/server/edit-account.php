<?php
$error1 = 0;
$error2 = 0;
$error3 = 0;
$validateSuccessChange = 1;
if(isset($_POST['changePassword'])) {
	$currentPassword = strip_tags($_POST['currentpassword']);
	$newPassword = strip_tags($_POST['newpassword']);
	$cnewPassword = strip_tags($_POST['cnewpassword']);

	if(empty($currentPassword)) {
		$error1 = 1;
		$validateSuccessChange = 0;
	}

	if(empty($newPassword)) {
		$error2 = 1;
		$validateSuccessChange = 0;
	}

	if(empty($cnewPassword)) {
		$error2 = 1;
		$validateSuccessChange = 0;
	}

	if($validateSuccessChange == 1) {
		$getQuery = mysqli_query($dbconnect, "SELECT * FROM paneladmin WHERE userID = '".$_SESSION['userID']."'");
		$getData = mysqli_fetch_assoc($getQuery);
		$salt = $getData['passwordsalt'];
		$currentPassword = sha1(crypt($currentPassword, $salt));

		if($currentPassword === $getData['password']) {
			if($newPassword === $cnewPassword) {
				$newPassword = sha1(crypt($newPassword, $salt));
				mysqli_query($dbconnect, "UPDATE paneladmin SET password = '".$newPassword."' WHERE userID = '".$_SESSION['userID']."'");
			}
		} else {
			$error3 = 1;
		}

	}

}