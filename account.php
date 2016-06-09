<?php 
  $access = 1;
  require('resources/server/configuration.php');
  if(userLoggedIn()) {} else {header('location: index.php');}
  require('resources/server/edit-account.php');
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
  
    <h1 style="font-size: 50px;"> ACCOUNT </h1>
<?php
    if($error1 == 1) {
      echo "<h3 style='color: #424242;'>Invalid Current Password</h3>";
    }
    if($error2 == 1) {
      echo "<h3 style='color: #424242;'>Invalid New Password</h3>";
    }
    if($error3 == 1) {
      echo "<h3 style='color: #424242;'>Passwords do not match.</h3>";
    }
?>
    <h3 style="color: #2ecc71; font-size: 20px; margin-bottom: 25px;">Change Password</h3>
    <form action="account.php" method="post">

    <p>CURRENT PASSWORD</p>
    <input type="password" name="currentpassword" class="text-input-green">

    <p>NEW PASSWORD</p>
    <input type="password" name="newpassword" class="text-input-green">

    <p>CONFIRM NEW PASSWORD</p>
    <input type="password" name="cnewpassword" class="text-input-green">

    <input type="submit" name="changePassword" value="Update Password" class="button-green">

    </form>

  </div>

  </div>

</body>
</html>
