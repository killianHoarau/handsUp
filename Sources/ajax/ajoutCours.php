<?php 
session_start();
$idEnseignant = $_SESSION["id"];
$libelle = $_POST['libelle'];
$description = $_POST['addDescription'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "SELECT MAX(id) as id FROM cours";
$result = $link->query($query);
$row = $result->fetch_assoc();
$newId = $row['id']+1;

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
 // echo $file;
 $sql = "INSERT INTO cours (libelle, description, nomFichier, idEnseignant) 
 VALUES ('$libelle', '$description', '$file', $idEnseignant)";
 // $sql = "UPDATE cours SET nomFichier = '$file' WHERE annee = $annee
				// IF @@ROWCOUNT=0
			// INSERT INTO CNIL_bilan (fichier_joint, annee) VALUES ('$file', $annee)";
echo $sql;
$result = $link->query($sql);
 header("Location: ../pages/compte.php");
?>