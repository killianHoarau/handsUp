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
				<div  class="dc-single-product-configuration" name="trCours" id="<?php echo $row['idCours']; ?>">
					<?php echo utf8_encode($row['libelle']); ?> - <?php echo $row['loginEnseignant']; ?>
					<i id="<?php echo $row['idCours']; ?>" class="fa fa-trash-o fa-lg poubelle" aria-hidden="true"></i>
				</div>
				<div id="dc-config-panel" name="trInfos<?php echo $row['idCours']; ?>">
					<?php echo utf8_encode($row['description']); ?>
					<button id="btFermer">Fermer</button>
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
				<div  class="dc-single-product-configuration" name="trCours" id="<?php echo $row['id']; ?>">
					<?php echo utf8_encode($row['libelle']); ?>
				</div>
				<!--DIV INFO-->
				<div id="dc-config-panel" name="trInfos<?php echo $row['id']; ?>">
					<!--Champs QRCODE -->
					<input id="text<?php echo $row['id']; ?>" name="linkQR" type="hidden" value="http://localhost/handsup/Sources/pages/cours.php?idCours=<?php echo $row['id'];?>"/>
					<div id="qrcode<?php echo $row['id']; ?>" class="col-md-12 petitQR"></div>

					<!--DESCRIPTION ET BOUTONS-->
					<div class="col-md-12">
						<?php echo utf8_encode($row['description']); ?>
						<i id="stat<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="fa fa-bar-chart" aria-hidden="true"></i>
						<i id="<?php echo $row['id']; ?>" class="fa fa-trash-o fa-lg poubelle" name="supprimerCours" aria-hidden="true"></i>
						<i id="" class="fa fa-pencil-square-o fa-lg edit" aria-hidden="true"></i>
						<i id="qcm<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" class="fa fa-plus-circle fa-lg plus" aria-hidden="true"></i>

						<!--DOWNLOAD-->
	<?php				 if (!empty($row["nomFichier"])) { ?>
							<form action="../ajax/downloadFile.php" method="post">
								<input type="hidden" value="<?php echo $row['id']; ?>" name="idCours">
								<i id="" class="fa fa-download fa-lg load" name="dl<?php echo $row['id']; ?>" aria-hidden="true"></i>
							</form>

						<!--UPLOAD-->
	<?php 				}else {
							?>
							<form action="../ajax/ajoutCours.php" method="POST" id="ajoutPJ" enctype="multipart/form-data" class="wow fadeInDown msform animated">
								<input type="hidden" value="<?php echo $row['id']; ?>" name="idCours"/>
								<input type="file" id="Ajouthiddenfile<?php echo $row['id']; ?>" style="display:none;" name="file"/><!--onChange="Ajoutgetvalue();"-->
								<input type="text" id="Ajoutselectedfile<?php echo $row['id']; ?>" placeholder="Fichier Selectionné" disabled="disabled"/>
								<i id="" class="fa fa-upload fa-lg load" name="ul<?php echo $row['id']; ?>" aria-hidden="true" ></i><!--onclick="Ajoutgetfile();"-->
								<input id="submitAddPJ<?php echo $row['id']; ?>" type="submit" value="Envoyer" class="action-button"/>
							</form>
	<?php				 } ?>
					</div>
					<button name="btnFermer">Fermer</button>
				</div>
			</div>
	<?php
		} ?>

	</section>
<?php }
} ?>
<script>
	$(document).ready(function(){
		$("#popup").hide();
		$("input[id^='Ajoutselectedfile']").hide();
		$("input[id^='submitAddPJ']").hide();
		$("div[name^='trInfos']").hide(); //Cache toutes les div dont le name commence par 'trInfos'
		$("div[name='trCours']").click(function(){
			var id = this.id;
			if ($('div[name="trInfos'+id+'"]').is(":visible")){
				$('div[name="trInfos'+id+'"]').slideUp(1000);
			}else{
				$('div[name="trInfos'+id+'"]').slideDown(1000);
			}
		});
	});
		//Suppression au click sur la poubelle
		$( "i[name^='supprimerCours']" ).click(function(){
			var ide = this.id;
			//alert(ide);
			//On rappelle getCours pour faire la modif et afficher la liste des cours Mise a jour (sans rechargement)
			$.ajax({
				url: "../ajax/getCours.php",
				type: 'POST',
				async: true,
				data : {
					suppr : ide
					},
				success: function(code_html)
				{
					$('#listCours').html(code_html);
				}
			});
		});

		//Telechargement du fichier joint a chaque cours lors du clique sur le <i> download
		$("i[name^='dl']").click(function(){
			$(this).closest("form").submit();
			return false;
		});

		//Upload du fichier pour un cours qui n'en a pas deja
		$("i[name^='ul']").click(function(){
			var name = this.getAttribute("name");
			var idPasse = name.substring(2);
			$("input[id='Ajoutselectedfile" + idPasse +"']").show();
			$("input[id^='submitAddPJ']").show();
			document.getElementById('Ajouthiddenfile'+idPasse+'').click();
		});

		//Affiche le fichier selectionne
		$("input[id^=Ajouthiddenfile]").change(function(){
			var id = this.id;
			var idCours = id.substring(15);
			$("#Ajoutselectedfile" + idCours).val(this.value);
		});

		$("i[id^='qcm']").click(function() {
			document.location.href = "creationQCM.php?idCours="+this.attributes["name"].value;
		});

		$('button[name="btnFermer"]').click(function(){
			var name = this.parentNode.getAttribute("name");
			name = name.substring(7);
			$('div[name="trInfos'+name+'"]').slideUp(name);
		});

		//Créé le QR code pour chaque cours
		var tabQR = document.getElementsByName('linkQR');
		for(var i=0; i<tabQR.length; i++)
		{
			var id = tabQR[i].id.substring(4);
			//console.log(id);
			var qr = new QRCode("qrcode"+id);
			qr.makeCode($('#text'+id).val());	//Créé le QR avec la valeur de l'input text qui est caché
			$('#qrcode' + id).find("img").css({"width": "30px"});	//Permet d'afficher le QR en petit

			//Affiche la popup du QRCode en gros pour pouvoir le scanner
			$('#qrcode' + id).find("img").click(function(){
				// alert(this.nodeName);
				var idclicked = this.parentNode.id.substring(6);
				//alert(idclicked);
				var imgClone = this.cloneNode(true);
				imgClone.style.width = "50%";
				$('#popup').append(imgClone);
				$('#popup').show();
			});
		}

		$('#closepopup').click(function(){
			$('#popup').children('img').remove();
			$('#popup').hide();
		});

		//Redirection vers la page de stat global
		$("i[id^='stat']").click(function(){
			document.location.href = "stat.php?idCours="+this.attributes["name"].value;
		});
</script>
