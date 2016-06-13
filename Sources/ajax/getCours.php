<?php
session_start();
$id = $_SESSION["id"];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

if(isset($_POST['suppr']))
{
	$idCours = $_POST['suppr'];
	$query = "DELETE FROM suivre_cours
				WHERE idCours = $idCours
				AND idUtilisateur = $id;";
	$result = $link->query($query);
}





if ($_SESSION["droit"] == 0) {  // Etudiant

	$query = "SELECT cours.id as 'idCours', libelle, description, login as 'loginEnseignant'  FROM cours, suivre_cours, utilisateur WHERE cours.id = suivre_cours.idCours AND utilisateur.id = cours.idEnseignant AND suivre_cours.idUtilisateur = '$id';";
	// die(var_dump($query));
	$cours = array(array());
	$i = 0;

	$result = $link->query($query);
	if ($result->num_rows > 0) {
	?>	
	<h2>Voici vos cours</h2>
	<p class="lead">A partir d'ici vous pouvez visualiser mais aussi modifier vos cours</p>
		<table class="table">
			<thead>
				<tr>
					<th class="center">Cours</th>
					<th class="center">Description</th>
					<th class="center">Enseignant</th>
				</tr>
			</thead>
			<tbody>
	<?php
		while($row = $result->fetch_assoc()){
		?>
			<tr>
				<td><?php echo $row['libelle']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td><?php echo $row['loginEnseignant']; ?></td>
				<td style="padding: 0;"><i id="<?php echo $row['idCours']; ?>" class="fa fa-trash-o" style="color: #c52d2f; font-size: 2em;" aria-hidden="true"></i></td>
				<!--<td style="padding: 0;"><img id="supprimer<?php echo $row['idCours']; ?>" src="../images/ico/trash.png" class='img-responsive' style='height: 30px;' title="Supprimer" alt="Supprimer Cours"/></td>-->
			</tr>
	<?php
		}
	?>
			<tbody>
		</table>
	<?php	
	}
	else { ?> <p class="lead">Vous n'êtes inscrit à auncun cours</p> <?php }
}
else { 
	?> <span>Bonjour Professeur</span>
<?php } ?>

<script>
	//Suppression au click sur la poubelle
	$( "i" ).click(function(){
		var ide = this.id;
		//alert(id);
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
</script>