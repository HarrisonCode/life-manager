<?php
if(empty($access)) { die(); }

if(isset($_GET['search']) || isset($_GET['editPlayer'])) {

  if(!empty($_GET['search'])) {

    $search = strip_tags($_GET['search']);

    $checkQuery = mysqli_query($dbconnect, "SELECT * FROM players WHERE name LIKE '".mysqli_real_escape_string($dbconnect, $search)."'");

    if(mysqli_num_rows($checkQuery) > 0) {

?>
      <table class="show-players">
        <tr>
          <th>UID</th>
          <th>NAME</th>
          <th>COP</th>
          <th>MEDIC</th>
          <th>DONOR</th>
          <th>ADMIN</th>
          <th>CASH</th>
          <th>ATM</th>
          <th><i class="fa fa-cogs" aria-hidden="true"></i></th>
        </tr>
<?php

      while($getData = mysqli_fetch_assoc($checkQuery)) {
?>

        <tr>
          <td><?php echo $getData['playerid']; ?></td>
          <td><?php echo $getData['name']; ?></td>
          <td><?php echo $getData['coplevel']; ?></td>
          <td><?php echo $getData['mediclevel']; ?></td>
          <td><?php echo $getData['donorlevel']; ?></td>
          <td><?php echo $getData['adminlevel']; ?></td>
          <td><?php echo $getData['cash']; ?></td>
          <td><?php echo $getData['bankacc']; ?></td>
          <td><a href="players.php?editPlayer=<?php echo $getData['playerid']; ?>"><i class="fa fa-pencil" aria-hidden="true" style="color: white;"></i></a></td>
        </tr>

<?php
      }
?>
</table>
<?php

    } else {
      echo "<h3>No Results Found.</h3>";
    }

  } elseif(!empty($_GET['editPlayer'])) {

    require('resources/server/edit-players.php');

  }

} else {

$getAllPlayers = mysqli_query($dbconnect, "SELECT * FROM players");

?>
      <table class="show-players">
        <tr>
          <th>UID</th>
          <th>NAME</th>
          <th>COP</th>
          <th>MEDIC</th>
          <th>DONOR</th>
          <th>ADMIN</th>
          <th>CASH</th>
          <th>ATM</th>
          <th><i class="fa fa-cogs" aria-hidden="true"></i></th>
        </tr>
<?php

while($getData = mysqli_fetch_assoc($getAllPlayers)) {

?>
        <tr>
          <td style="font-size: 13px;"><?php echo $getData['playerid']; ?></td>
          <td><?php echo $getData['name']; ?></td>
          <td><?php echo $getData['coplevel']; ?></td>
          <td><?php echo $getData['mediclevel']; ?></td>
          <td><?php echo $getData['donorlevel']; ?></td>
          <td><?php echo $getData['adminlevel']; ?></td>
          <td><?php echo $getData['cash']; ?></td>
          <td><?php echo $getData['bankacc']; ?></td>
          <td><a href="players.php?editPlayer=<?php echo $getData['playerid']; ?>"><i class="fa fa-pencil" aria-hidden="true" style="color: white;"></i></a></td>
        </tr>

<?php
}
?>
</table>
<?php
}
?>