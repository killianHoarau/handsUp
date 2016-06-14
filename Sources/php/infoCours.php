<?php
$idCours = $_GET["idCours"];

$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

$query = "SELECT * FROM cours WHERE id = $idCours";
$result = $link->query($query);
$cours = $result->fetch_assoc();

?>
