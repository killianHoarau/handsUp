<?php
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$id = $_POST['id'];
$query = "SELECT count(*) as compteur FROM message_prive WHERE message_prive.idDestinataire = $id AND message_prive.lu = 0";
$result = $link->query($query);
$row = $result->fetch_assoc();
$compteur = $row['compteur'];
$return = json_encode($compteur);
echo $return;