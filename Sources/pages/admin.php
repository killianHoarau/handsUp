<?php
	session_start();
	// if (!isset($_SESSION['login'] == 2)){
	// 	header('Location: index.php');
	// }
	$title="Administration";
    include("header.php");
	include("../php/infoAdmin.php");
?>

<section id="feature" >
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2>Gérer les utilisateurs</h2>
		</div>
		<table id="listUtilisateur">
			<tr>
				<th>Login</th>
				<th>Mod de passe</th>
				<th>Statut</th>
				<th>Valide</th>
			</tr>
			<?php for ($i=0; $i < count($utilisateurs); $i++) { ?>
				<tr>
					<td><?php echo $utilisateurs[$i]["login"]; ?></td>
					<td><?php echo $utilisateurs[$i]["motDePasse"]; ?></td>
					<td><?php echo $utilisateurs[$i]["statut"]; ?></td>
					<td><?php if ($utilisateurs[$i]["valide"] == 0) {
						echo "Non";
					} else {
						echo "Oui";
					}?></td>
					<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteUser<?php echo $utilisateurs[$i]['id']; ?>" name="<?php echo $utilisateurs[$i]["id"]; ?>"></i></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</section>

<section id="feature" >
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2>Gérer les codes d'accès</h2>
		</div>
		<span id="btnShowAddCode">
			<i class="fa fa-plus-circle fa-lg"/></i> Ajouter un code
		</span>
		<span id="btnHideAddCode">
			<i class="fa fa-minus-circle  fa-lg"/></i> Annuler
		</span>

		<!-- Formulaire d'ajout de réponse -->
		<div class=" row msform">
			<div class="col-md-12 col-sm-12 add-code" data-wow-duration="1000ms" data-wow-delay="600ms">
				<div class="col-lg-4">
					<input type="text" name="code" value="" placeholder="Code">
				</div>
				<div class="col-lg-2">
					<input type="radio" name="statut" value="0"> Etudiant <br>
				</div>
				<div class="col-lg-2">
					<input type="radio" name="statut" value="1"> Enseignant <br>
				</div>
				<div class="col-md-2">
					<span id='btnAddCode' class="next action-button">Valider</span>
				</div>
			</div>
		</div>

		<table id="listCodeAcces">
			<tr>
				<th>Code</th>
				<th>Statut</th>
			</tr>
			<?php for ($i=0; $i < count($codes); $i++) { ?>
				<tr>
					<td><?php echo $codes[$i]["code"]; ?></td>
					<td><?php echo $codes[$i]["statut"]; ?></td>
					<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteCode<?php echo $codes[$i]['code']; ?>" name="<?php echo $codes[$i]["code"]; ?>"></i></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</section>


<?php
	$nomScript="admin";
    include("footer.php");
?>
