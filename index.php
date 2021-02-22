<!DOCTYPE html>
<html lang="en">
<head>
	<title>Domje's Simply ILVL Checker</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Rubik|Kaushan+Script" rel="stylesheet">
	<link rel="stylesheet" href="ilvl.css">
	
</head>
<body>
<div class="jumbotron text-center">
  <h1><a href="index.php"> Simple iLevel Checker </h1></a>
  	<p> Check a player's ilevel by giving their details below </p>	
  </div>
<div align="center" class="container">
	<form method="post">
    <div class="form-group" class="col-sm-3"><br>
    <h4> Enter Character Details & Click Submit </h4><br>
        <label for="charName">Character <span class="glyphicon glyphicon-user"></label>
        <input type="text" class="form-control" name="charName" id="charName">
    </div>
    <div class="form-group" class="col-sm-3">
        <label for="playerRealm">Realm <span class="glyphicon glyphicon-globe"></label>
          <input type="text" class="form-control" name="playerRealm" id="playerRealm">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form></br>
</div>

<?php

error_reporting(E_ERROR | E_PARSE); // Remove Errors

if (isset($_POST['submit']))
{	

	foreach($_POST as $xp=>$xv){

		$_POST[$xp] = str_replace(" ", "%20", $xv);
		$_POST[$xp] = str_replace("'", "%27", $_POST[$xp]);
	}



	$char_name = $_POST['charName'];
	$player_realm = $_POST['playerRealm'];

$url = 'https://eu.api.battle.net/wow/character/' . $player_realm . '/' .  $char_name  . '?fields=items&locale=en_GB&apikey=API_KEY_GOES_HERE';


$json = file_get_contents($url);
$data = json_decode($json, true);

$charname = $data['name'];
$realm = $data['realm'];
$ilvl = $data['items'] ['averageItemLevel'];
$ilvle = $data['items'] ['averageItemLevelEquipped'];
$thumb = "http://render-eu.worldofwarcraft.com/character/" . str_replace('avatar', 'profilemain', $data['thumbnail']);

echo '<h1> How they look: </h1><img src="'.$thumb.'">';
echo "<h1>" . "Character: </h1>"."<h4>" . $charname ."</h4>";
echo "<h1>" . "Realm: </h1>"."<h4>" . $realm ."</h4>";
echo "<h1>" . "Average ilvl: </h1>"."<h4>" . $ilvl ."</h4>";
echo "<h1>" . "Equipped ilvl: </h1>"."<h4>" . $ilvle ."</h4>";

}



?>
</div>
</body>

</html>
