<?php 
  $access = 1;
  require('resources/server/configuration.php');
  if(userLoggedIn()) {} else {header('location: index.php');}
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

  <a href="players.php"><div class="page-selector" style="background-color: #2ecc71;">PLAYERS</div></a>
  <a href="houses.php"><div class="page-selector" style="background-color: #3498db;">HOUSES</div></a>
  <a href="gangs.php"><div class="page-selector" style="background-color: #e74c3c;">GANGS</div></a>

  </div>

</body>
</html>
