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

	$result = $link->query($query);
	if ($result->num_rows > 0) {
	?>	
	<h2>Voici vos cours</h2>
	<p class="lead">A partir d'ici vous pouvez visualiser vos cours ou vous y désinscrire</p>
		<div class="table-responsive">
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
				<td style="padding: 0; border-top: 0"><i id="<?php echo $row['idCours']; ?>" class="fa fa-trash-o" style="color: #c52d2f; font-size: 2em;" aria-hidden="true"></i></td>
			</tr>
	<?php
		}
	?>
			</tbody>
		</table>
		<div>
	<?php	
	}
	else { ?> <p class="lead">Vous n'êtes inscrit à auncun cours</p> <?php }
}
else { //Enseignant
	$query = "SELECT * FROM cours where idEnseignant = $id";

	$result = $link->query($query);
	if ($result->num_rows > 0) {
	?>	
	<h2>Voici vos cours</h2>
	<p class="lead">A partir d'ici vous pouvez visualiser vos cours, les modifier ou en créer de nouveaux</p>
		<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="center">Cours</th>
				</tr>
			</thead>
			<tbody>
	<?php
		while($row = $result->fetch_assoc()){
		?>
			<tr id='<?php echo $row['id']; ?>' name="trCours">
				<td><?php echo $row['libelle']; ?></td>
				
			</tr>
			<tr name="trInfos<?php echo $row['id']; ?>">
				<td>
					<div class="col-md-12">
						<?php echo $row['description']; ?>
						<i id="<?php echo $row['idCours']; ?>" class="fa fa-trash-o" style="color: #c52d2f; font-size: 2em;" aria-hidden="true"></i>
					</div>
				</td>
			</tr>
	<?php
		}
	?>
			</tbody>
		</table>
		</div>
<?php }
} ?>

<script>
	$(document).ready(function(){
		$("tr[name^='trInfos']> td > div").hide(); //Cache toutes les div dont le name commence par 'trInfos'
		$("tr[name='trCours']").click(function(){
			var id = this.id;
			//alert('tr[name="trInfos'+id+"\"]");
			$('tr[name="trInfos'+id+"\"] > td > div").animate({
								height: 'toggle'
							});
		});
	});
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