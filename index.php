<?php 
  $access = 1;
  require('resources/server/configuration.php');
  if(userLoggedIn()) { } else { require('resources/server/account-login.php'); }
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
<?php 
  if(userLoggedIn()) {
?>
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
  <h1 style="font-size: 50px; color: #ffb400; margin-left: 100px;"> BEST PLAYERS </h1>

  <table class="best-players">
  <tr>
    <th>NAME</th>
    <th>CASH</th>
    <th>ATM</th>
    <th>Settings</th>
  </tr>
  <?php require('resources/server/top-players.php'); ?>
  </table>

  </div>

<?php } else { ?>
<body style="background-image: url('resources/client/images/bg.jpg');
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">

<form action='index.php' method='post'>
<div class="login-form-green animated zoomIn">
  <div class="login-title">LIFE-MANAGER</div>
  <div class="text">
      <p style="color: #424242; display: inline; font-size: 20px;">Username: </p><input type="text" name="username" class="login-input">
  </div>
  <div class="text">
      <p style="color: #424242; display: inline; font-size: 20px;">Password: </p><input type="password" name="password" class="login-input">
  </div>
  <div class="text">
    <input type="submit" name="submitLogin" value="Login" class="button-dark" style="margin: 0 auto; margin-top: 15px; padding-left: 25px; padding-right: 25px;">
  </div>
  <p style="margin-top: 10px;"> Author: <a href="https://www.harrisonlewis.design/create-lifemanager.html" target="_blank">Harrison Lewis</a> </p>
  <p style=""></p>
</div>
</form>

<?php } ?>

</body>
</html>
