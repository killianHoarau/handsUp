<?php
$login = $_POST['login'];
$mdp = $_POST['mdp'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "SELECT * FROM utilisateur WHERE login = '$login' AND motDePasse = '$mdp' AND valide = 1";
echo $query;
$result = $link->query($query);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	session_start();
	$_SESSION["id"] = $row['id'];
	$_SESSION["login"] = $row['login'];
	$_SESSION["droit"] = $row['statut'];
	$_SESSION["email"] = $row['email'];
	header('Location: ../pages/index.php');
}
else
	echo "aucun resultat".$result->num_rows;
?>
