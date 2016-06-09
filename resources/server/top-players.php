<?php
if(empty($access)) { die(); }

$getPlayers = mysqli_query($dbconnect, "SELECT * FROM players LIMIT 5");

if(mysqli_num_rows($getPlayers) > 0) {
	while($getData = mysqli_fetch_assoc($getPlayers)) {
?>
  <tr>
    <td class="name"><?php echo $getData['name']; ?></td>
    <td><?php echo $getData['cash']; ?></td>
    <td><?php echo $getData['bankacc']; ?></td>
    <td><a href="players.php?editPlayer=<?php echo $getData['playerid']; ?>"><i class="fa fa-pencil" aria-hidden="true" style="color: white;"></i></a></td>
  </tr>
<?php
	}
} else {
	echo "<h1 style='margin-left: 100px;'>No users were found.</h1>";
}
?>