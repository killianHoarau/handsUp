<?php
$email = $_GET['email'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "UPDATE utilisateur set valide = 1
		WHERE email = '$email'";

$result = $link->query($query);
?>
<div class='col-md-12'>
	<span class='col-md-12'>Bienvenu sur HandsUp !</span>
	<span class='col-md-12'>Hop hop hop au boulot maintenant</span>
</div>
