<?php 
  $access = 1;
  require('resources/server/configuration.php');
  if(userLoggedIn()) {} else {header('location: index.php');}

$error1 = 0;
$error2 = 0;
$error3 = 0;
$updateSuccess = 0;
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

    $existQuery = mysqli_query($dbconnect, "SELECT * FROM paneladmin WHERE username = '".$regUsername."' LIMIT 1");
    if(mysqli_num_rows($existQuery) == 1) {
      $validateSuccess = 1;
      $error3 = 1;
    }

    if($validateSuccess == 0) {
      $salt = uniqid('', true);
      $regPassword = sha1(crypt($regPassword, $salt));
      mysqli_query($dbconnect, "INSERT INTO paneladmin VALUES ('', '".$regUsername."', '".$regPassword."', '".$salt."', '1', '1')");
    }
  }

  $currenUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      if(isset($_POST['editSubmit']) && $_SESSION['level'] == 3) {
        $newLevel = mysqli_real_escape_string($dbconnect, strip_tags($_POST['level']));
        $newBanStatus = mysqli_real_escape_string($dbconnect, strip_tags($_POST['banselect']));

        if(mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM paneladmin WHERE userID = '".$_GET['editAdmin']."'")) > 0) {
          mysqli_query($dbconnect, "UPDATE paneladmin SET level = '".$newLevel."', banned = '".$newBanStatus."' WHERE userID = '".$_GET['editAdmin']."'");
        }

        $updateSuccess = 1;

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
  <link rel="stylesheet" href="resources/client/css/default.css">
  <link rel="stylesheet" href="resources/client/css/theme.css">

</head>
<body>

  <div class="sidebar">
    <ul>
      <div class="profile">
          <img src="http://placehold.it/150x150">
          <p><?php echo $_SESSION['username']; ?></p>
          <span class="rank">ADMINISTRATOR</span>
      </div>
      <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
      <li><a href="pages.php"><i class="fa fa-file-o" aria-hidden="true"></i> Pages</a></li>
      <li><a href="managment.php"><i class="fa fa-cogs" aria-hidden="true"></i> Managment</a></li>
      <li><a href="account.php"><i class="fa fa-user" aria-hidden="true"></i> Account</a></li>
      <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
      <li><a href="https://www.harrisonlewis.design" target="_blank" class="author">Designed By: Harrison Lewis</a></li>
    </ul>
  </div>

  <div class="wrapper">
  .
  <div class="managment-container">
  <h1> CREATE NEW ACCOUNT </h1>
  <?php if($_SESSION['level'] == 3)  { ?>

  <?php
    if($error1 == 1) {
      echo "<h3 style='color: #424242;'>Invalid Username</h3>";
    }
    if($error2 == 1) {
      echo "<h3 style='color: #424242;'>Invalid Password</h3>";
    }
    if($error3 == 1) {
      echo "<h3 style='color: #424242;'>User Already Exists</h3>";
    }
  ?>

    <form action="managment.php" method="post">

    <p>Username</p>
    <input type="text" class="text-input-green" name="regUsername">

    <p>Password</p>
    <input type="text" class="text-input-green" name="regPassword">

    <input type="submit" value="Create New User" name="createAccount" class="button-green">

    </form>

  <?php } else { ?>
    <h3> Not a high enough rank </h3>
  <?php } ?>
  <h1 style="margin-top: 15px;"> View Admins </h1>
  <?php if($updateSuccess == 1) { ?>
  <div style="width: 25%; background-color: #2ecc71; padding: 10px; color: white; font-size: 20px;">
   Updated Account
  </div>
  <?php } ?>
  <?php
    $showAdmins = mysqli_query($dbconnect, "SELECT * FROM paneladmin");

?>
      <table class="show-players">
        <tr>
          <th>UID</th>
          <th>USERNAME</th>
          <th>LEVEL</th>
          <th>BANNED</th>
          <th><i class="fa fa-cogs" aria-hidden="true"></i></th>
        </tr>
<?php

    if(isset($_GET['editAdmin']) && $_SESSION['level'] == 3) {
    $getAdmin = mysqli_query($dbconnect, "SELECT * FROM paneladmin WHERE userID = '".$_GET['editAdmin']."'");
    $getData = mysqli_fetch_assoc($getAdmin);  
?>
    <form action="<?php echo $currenUrl; ?>" method="post" id="editAdmin">
        <tr>
          <td><?php echo $getData['userID']; ?></td>
          <td><?php echo $getData['username']; ?></td>
          <td><input type="number" min="1" max="3" step="1" value="<?php echo $getData['level']; ?>" name="level"></td>
          <td><select name="banselect" form="editAdmin"><option value="2" <?php if($getData['banned'] == 2) { echo "selected='selected'"; }?>>Yes</option><option value="1" <?php if($getData['banned'] == 1) { echo "selected='selected'"; }?>>No</option></select></td>
          <td><input type="submit" name="editSubmit" class="button-dark" value="Save Changes"></td>
        </tr>
    </form>
<?php
    } else {

    while($getData = mysqli_fetch_assoc($showAdmins)) {
?>

        <tr>
          <td><?php echo $getData['userID']; ?></td>
          <td><?php echo $getData['username']; ?></td>
          <td><?php echo $getData['level']; ?></td>
          <td><?php if($getData['banned'] == 1) { echo "No"; } else { echo "Yes"; } ?></td>
          <td><a href="?editAdmin=<?php echo $getData['userID']; ?>" style="color: white;">EDIT</a></td>
        </tr>

<?php      
    }
}
  ?>


  </div>

  </div>

</body>
</html>
