<?php 
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
 $file = $annee.$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="../bilanFichiers/";
 $list = glob('../bilanFichiers/'.$annee.'*');
 var_dump($list);
 for($i=0;$i<count($list);$i++)
 {
	 unlink($list[$i]);
 }
 move_uploaded_file($file_loc,$folder.$file);
 // echo $file;
 $sql = "UPDATE CNIL_bilan SET fichier_joint = '$file' WHERE annee = $annee
				IF @@ROWCOUNT=0
			INSERT INTO CNIL_bilan (fichier_joint, annee) VALUES ('$file', $annee)";
 $res = odbc_exec($odbc_bsi, $sql);
 header("Location: ../bilan.php");
?>