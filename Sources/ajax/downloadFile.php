<?php
$idCours = $_POST['idCours'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "SELECT nomFichier FROM cours WHERE id = $idCours";
$result = $link->query($query);
$row = $result->fetch_assoc();
$fichier = $row['nomFichier'];	
$chemin = "../coursFichier/$fichier";
header("Content-Disposition: attachment; filename=$fichier");
readfile($chemin);
?>