<?php
session_start();
if (isset($_POST['idCours']))
	$idCours = $_POST['idCours'];
else
	$idCours = 0;
$idEnseignant = $_SESSION["id"];
$libelle = $_POST['libelle'];
$description = $_POST['addDescription'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "SELECT MAX(id) as id FROM cours";
$result = $link->query($query);
$row = $result->fetch_assoc();
$newId = $row['id']+1;
if(!empty($_FILES['file']['name']))
{
	$file = $newId.$_FILES['file']['name'];
	$file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="../coursFichiers/";
	$list = glob('../coursFichiers/'.$newId.'*');
	var_dump($list);
	for($i=0;$i<count($list);$i++)
	{
		unlink($list[$i]);
	}
	move_uploaded_file($file_loc,$folder.$file);
}
if($idCours!=0)
	$sql = "UPDATE cours SET nomFichier = '$file' WHERE id = $idCours";
else
	$sql = "INSERT INTO cours (libelle, description, nomFichier, idEnseignant)
				VALUES ('$libelle', '$description', '$file', $idEnseignant)";
echo $sql;
$result = $link->query($sql);


//SUIVRE LE COURS
$query = "SELECT id FROM cours WHERE idEnseignant =$idEnseignant and libelle = '$libelle';";
$result = $link->query($sql);
$row = $result->fetch_assoc();
$idNewCours = $row['id'];

$query="INSERT INTO suivre_cours VALUES ($idEnseignant, $idNewCours)";
$result = $link->query($sql);

header("Location: ../pages/compte.php");
?>
