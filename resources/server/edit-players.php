<?php 
if(empty($access)) { die(); }

if($_SESSION['level'] > 1) {

    $getPlayer = strip_tags($_GET['editPlayer']);
    $getPlayer = mysqli_real_escape_string($dbconnect, $getPlayer);

	if(isset($_POST['submitSettings'])) {

		$playerCash = $_POST['playercash'];
		$playerBank = $_POST['playerbank'];
		$playerCop = $_POST['coplevel'];
		$playerMedic = $_POST['mediclevel'];
		$playerDonor = $_POST['donorlevel'];
		$playerAdmin = $_POST['adminlevel'];
		$playerBlacklisted = $_POST['blacklist'];
		$playercivlicenses = $_POST['civlicenses'];
		$playercoplicenses = $_POST['coplicenses'];
		$playermedlicneses = $_POST['mediclicenses'];
		$playercivgear = $_POST['civgear'];
		$playercopgear = $_POST['copgear'];
		$playermedgear = $_POST['medicgear'];

		mysqli_query($dbconnect, 
			"UPDATE players SET 
			cash='".$playerCash."',
			bankacc='".$playerBank."',
			coplevel='".$playerCop."',
			mediclevel='".$playerMedic."',
			donorlevel='".$playerDonor."',
			adminlevel='".$playerAdmin."',
			blacklist='".$playerBlacklisted."',
			civ_licenses='".$playercivlicenses."',
			cop_licenses='".$playercoplicenses."',
			med_licenses='".$playermedlicneses."',
			civ_gear='".$playercivgear."',
			cop_gear='".$playercopgear."',
			med_gear='".$playermedgear."'
			WHERE playerid = '".$getPlayer."' "
		);

	}

	$currenUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $getQuery = mysqli_query($dbconnect, "SELECT * FROM players WHERE playerid = '".$getPlayer."'");

    if(mysqli_num_rows($getQuery) == 1) {
    $getData = mysqli_fetch_assoc($getQuery);
    	// add function to view and edit all variables listed in the database.
    	// exclude the name, uid, playerid as they are variables that should
    	// not be changed anyway.
    ?>

    <p class="sub-view">Player Name: <?php echo $getData['name']; ?></p>
    <p class="sub-view">PLAYER ID: <?php echo $getData['playerid']; ?></p>
    <form action="<?php echo $currenUrl; ?>" method="post" id="playeredit">
    <span class="text-view">PLAYER CASH:</span><input type="text" name="playercash" class="text-input-green" value="<?php echo $getData['cash']; ?>">
    <span class="text-view">PLAYER BANK:</span><input type="text" name="playerbank" class="text-input-green" value="<?php echo $getData['bankacc']; ?>">
    <span class="text-view">COP LEVEL:</span><input type="text" name="coplevel" class="text-input-green" value="<?php echo $getData['coplevel']; ?>">
    <span class="text-view">MEDIC LEVEL:</span><input type="text" name="mediclevel" class="text-input-green" value="<?php echo $getData['mediclevel']; ?>">
    <span class="text-view">DONOR LEVEL:</span><input type="text" name="donorlevel" class="text-input-green" value="<?php echo $getData['donorlevel']; ?>">
    <span class="text-view">ADMIN LEVEL:</span><input type="text" name="adminlevel" class="text-input-green" value="<?php echo $getData['adminlevel']; ?>">
    <span class="text-view">BLACKLISTED:</span><select class="select-style" form="playeredit" name="blacklist"><option value="0" <?php if($getData['blacklist'] == 0) { echo "selected='selected'"; } ?>>No</option><option value="1" <?php if($getData['blacklist'] == 1) { echo "selected='selected'"; }?>>Yes</option></select>
    
    <span class="text-view" style="display: block; margin-top: 10px;">CIVILIAN LICENSES:</span>
    <textarea name="civlicenses" class="text-input-green" cols="50" rows="10">
    <?php echo $getData['civ_licenses']; ?>
    </textarea>
    <span class="text-view" style="display: block; margin-top: 10px;">COP LICENSES:</span>
    <textarea name="coplicenses" class="text-input-green" cols="50" rows="10">
    <?php echo $getData['cop_licenses']; ?>
    </textarea>
       <span class="text-view" style="display: block; margin-top: 10px;">MEDIC LICENSES:</span>
    <textarea name="mediclicenses" class="text-input-green" cols="50" rows="10">
    <?php echo $getData['med_licenses']; ?>
    </textarea>
    <span class="text-view" style="display: block; margin-top: 10px;">CIVILIAN GEAR:</span>
    <textarea name="civgear" class="text-input-green" cols="50" rows="10">
    <?php echo $getData['civ_gear']; ?>
    </textarea>
    <span class="text-view" style="display: block; margin-top: 10px;">COP GEAR:</span>
    <textarea name="copgear" class="text-input-green" cols="50" rows="10">
    <?php echo $getData['cop_gear']; ?>
    </textarea>
       <span class="text-view" style="display: block; margin-top: 10px;">MEDIC GEAR:</span>
    <textarea name="medicgear" class="text-input-green" cols="50" rows="10">
    <?php echo $getData['med_gear']; ?>
    </textarea>

    <input type="submit" name="submitSettings" class="button-green" value="Save Settings">

    </form>

<?php
    } else {
?>
    <div style="width: 25%; background-color: #2ecc71; color: white; padding: 10px; margin-top: 15px;">
   No User Found.
    </div>
<?php
    }
?>
    <?php
} else {
?>
    <div style="width: 25%; background-color: #2ecc71; color: white; padding: 10px; margin-top: 10px;">
    Access Denied. You must be rank 2 and above.
    </div>
<?php
}