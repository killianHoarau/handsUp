<?php
$login = $_POST['login'];
$mdp = $_POST['mdp'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "SELECT * FROM utilisateur WEHRE login = '$login' AND motDePasse = '$mdp';";
echo $query;
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc())
	{
		echo $row['login'];
		echo $row['motDePasse'];
	}
}
else
	echo "aucun resultat".$result->num_rows;
?>
