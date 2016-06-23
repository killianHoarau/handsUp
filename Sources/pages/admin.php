<?php
	$title="Administration";
	include("header.php");
	include("../php/infoAdmin.php");

	if ($_SESSION['droit'] != 2){
		header('Location: index.php');
	}
?>

<section id="feature" >
	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			   <div class="center wow fadeInDown">
					<h2>Gérer les utilisateurs</h2>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="listUtilisateur">
						<thead>
							<tr>
								<th>Login</th>
								<th>Email</th>
								<th>Statut</th>
								<th>Valide</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i=0; $i < count($utilisateurs); $i++) { ?>
								<tr>
									<td><?php echo $utilisateurs[$i]["login"]; ?></td>
									<td><?php echo $utilisateurs[$i]["email"]; ?></td>
									<td>
<?php
										if($utilisateurs[$i]["statut"]==0) echo "Etudiant";
										else if($utilisateurs[$i]["statut"]==1) echo "Enseignant";
										else if($utilisateurs[$i]["statut"]==2) echo "Administrateur";
?>
									</td>
									<td><?php if ($utilisateurs[$i]["valide"] == 0) {
										echo "Non";
									} else {
										echo "Oui";
									}?></td>
									<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteUser<?php echo $utilisateurs[$i]['id']; ?>" name="<?php echo $utilisateurs[$i]["id"]; ?>"></i></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
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
						<div class="col-lg-2 checkbox checkbox-info checkbox-circle">
							<input type="radio" name="statut" value="0" id="btnEtudiant">
							<label for="btnEtudiant">Etudiant</label>
						</div>
						<div class="col-lg-2 checkbox checkbox-info checkbox-circle">
							<input type="radio" name="statut" value="0" id="btnEnseignant">
							<label for="btnEnseignant">Enseignant</label>
						</div>
						<div class="col-md-2">
							<span id='btnAddCode' class="next action-button">Valider</span>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="listCodeAcces">
						<thead>
							<tr>
								<th>Code</th>
								<th>Statut</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i=0; $i < count($codes); $i++) { ?>
								<tr>
									<td><?php echo $codes[$i]["code"]; ?></td>
									<td><?php echo $codes[$i]["statut"]; ?></td>
									<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteCode<?php echo $codes[$i]['code']; ?>" name="<?php echo $codes[$i]["code"]; ?>"></i></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="feature" >
	<div class="container">

	</div>
</section>


<?php
	$nomScript="admin";
    include("footer.php");
?>
