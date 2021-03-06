<?php
session_start();
$id = $_SESSION["id"];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

if(isset($_POST['suppr'])) {
	$idCours = $_POST['suppr'];
	if ($_SESSION["droit"] == 0) {
		$query = "DELETE FROM suivre_cours
					WHERE idCours = $idCours
					AND idUtilisateur = $id;";
		$result = $link->query($query);
	}else {
		$query = "SELECT nomFichier FROM cours WHERE id=$idCours;";
		$result = $link->query($query);
		$row = $result->fetch_assoc();
		$file = $row['nomFichier'];
		$query = "DELETE FROM cours	WHERE id = $idCours;";
		$result = $link->query($query);
		$list = glob('../coursFichiers/'.$file);
		for($i=0;$i<count($list);$i++)
		{
			unlink($list[$i]);
		}
		//unlink($file[0]);
		//*array_map( "unlink", $file);
	}
}





if ($_SESSION["droit"] == 0) {  // Etudiant

	$query = "SELECT cours.id as 'idCours', libelle, description, login as 'loginEnseignant'  FROM cours, suivre_cours, utilisateur WHERE cours.id = suivre_cours.idCours AND utilisateur.id = cours.idEnseignant AND suivre_cours.idUtilisateur = '$id';";
	// die(var_dump($query));

	$result = $link->query($query);
	if ($result->num_rows > 0) {
	?>
	<h2>Voici vos cours</h2>
	<p class="lead">A partir d'ici vous pouvez visualiser vos cours ou vous en désinscrire</p>
	<section id="feature" class="row">
	<?php
		while($row = $result->fetch_assoc()){
		?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dc-box">
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dc-single-product-configuration" name="trCours" id="<?php echo $row['idCours']; ?>">
					<?php echo utf8_encode($row['libelle']); ?> - <?php echo $row['loginEnseignant']; ?>
					<i id="goCours<?php echo $row['idCours']; ?>" name="<?php echo $row['idCours']; ?>" class="fa fa-file-text-o petit" aria-hidden="true"></i>
					<i data-toggle="modal" data-target="#myModal" name="confSupr" id="confSupr<?php echo $row['idCours']; ?>" class="fa fa-trash-o poubellePetit fa-2x"  aria-hidden="true"></i>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="dc-config-panel" name="trInfos<?php echo $row['idCours']; ?>">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php echo utf8_encode($row['description']); ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 msform">
						<button class="next oubli-button" name="btnFermer">Fermer</button>
					</div>
				</div>
			</div>
	<?php
		}
	?>
	</section>
	<?php
	}
	else { ?> <p class="lead">Vous n'êtes inscrit à aucun cours</p> <?php }
}
else { //Enseignant
	$query = "SELECT * FROM cours where idEnseignant = $id";

	$result = $link->query($query);
	if ($result->num_rows > 0) {
	?>
	<h2>Voici vos cours</h2>
	<p class="lead">A partir d'ici vous pouvez visualiser vos cours, les modifier ou en créer de nouveaux</p>
	<section id="feature" class="row">
	<?php
		while($row = $result->fetch_assoc()){
		?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dc-box">
				<!--DIV COURS-->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dc-single-product-configuration" title="monLibelle" value="<?php echo $row['libelle']; ?>" name="trCours" id="<?php echo $row['id']; ?>">
					<?php echo utf8_encode($row['libelle']); ?>
				</div>
				<!--DIV INFO-->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="dc-config-panel" name="trInfos<?php echo $row['id']; ?>">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row margin-cours">
							<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
								<!--Champs QRCODE -->
								<input id="text<?php echo $row['id']; ?>" name="linkQR" type="hidden" value="http://localhost/handsup/Sources/pages/cours.php?idCours=<?php echo $row['id'];?>"/>
								<div data-toggle="modal" data-target="#myModalQR" id="qrcode<?php echo $row['id']; ?>" class="petitQR"></div>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
								<i id="stat<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="fa fa-bar-chart stats fa-3x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
								<i data-toggle="modal" data-target="#myModal" name="confSupr" id="confSupr<?php echo $row['id']; ?>" class="fa fa-trash-o poubelle fa-3x"  aria-hidden="true"></i>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
								<i data-toggle="modal" data-target="#myModalCoursModif" id="modif<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="fa fa-pencil-square-o edit fa-3x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
								<div id="logoCQMfull">
									<img id="qcm<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="icoQCM" src="../images/ico/qcm.png"/>
								</div>
								<div id="logoCQMmobile" hidden>
									<img id="qcm<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="icoQCM" src="../images/ico/qcmSmall.png"/>
								</div>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
								<i id="goCours<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="fa fa-file-text-o grand" aria-hidden="true"></i>
							</div>
						</div>
						<div class="row margin-cours" id="desc<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>">
							<!--DESCRIPTION ET BOUTONS-->
							<?php echo utf8_encode($row['description']); ?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<!--DOWNLOAD-->
	<?php				 if (!empty($row["nomFichier"])) { ?>
							<form action="../ajax/downloadFile.php" method="post">
								<input type="hidden" value="<?php echo $row['id']; ?>" name="idCours">
								<i id="" class="fa fa-download fa-lg load fa-3x" name="dl<?php echo $row['id']; ?>" aria-hidden="true"></i>
							</form>

						<!--UPLOAD-->
	<?php 				}else {
							?>
							<form action="../ajax/ajoutCours.php" method="POST" id="ajoutPJ" enctype="multipart/form-data" class="wow fadeInDown msform animated compteForm">
								<input type="hidden" value="<?php echo $row['id']; ?>" name="idCours"/>
								<input type="file" id="Ajouthiddenfile<?php echo $row['id']; ?>" style="display:none;" name="file"/><!--onChange="Ajoutgetvalue();"-->
								<input type="text" id="Ajoutselectedfile<?php echo $row['id']; ?>" placeholder="Fichier Selectionné" disabled="disabled" style="display: none;"/>
								<i id="" class="fa fa-upload fa-lg load fa-3x" name="ul<?php echo $row['id']; ?>" aria-hidden="true" ></i><!--onclick="Ajoutgetfile();"-->
								<input id="submitAddPJ<?php echo $row['id']; ?>" type="submit" value="Envoyer" class="action-button" style="display: none;"/>
							</form>
	<?php				 } ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 msform"><button class="next oubli-button" name="btnFermer">Fermer</button></div>
				</div>
			</div>
	<?php
		} ?>

	</section>
<?php }
} ?>
<script src="../js/getCours.js"></script>
