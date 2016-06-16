<?php
session_start();

$idUtilisateur = $_POST['idUtilisateur'];
$code = $_POST['code'];
$codeAjout = $_POST['codeAjout'];
$statut = $_POST['statut'];
$ajout = $_POST['ajout'];

$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

if (!empty($idUtilisateur)) {
	//Supprime l'utilisateur
	$query = "DELETE FROM utilisateur WHERE id = $idUtilisateur;";
	$result = $link->query($query);

	$query = "SELECT * FROM utilisateur;";
	$result = $link->query($query); ?>

	<div class="table-responsive">
		<table class="table table-striped" id="listUtilisateur">
			<thead>
				<tr>
					<th>Login</th>
					<th>Email</th>
					<th>Statut</th>
					<th>Valide</th>
				</tr>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()){	?>
					<tr>
						<td><?php echo $row["login"]; ?></td>
						<td><?php echo $row["email"]; ?></td>
						<td>
<?php 
							if($row["statut"]==0) echo "Etudiant";
							else if($row["statut"]==1) echo "Enseignant";
							else if($row["statut"]==2) echo "Administrateur";
?>
						</td>
						<td>
							<?php if ($row["valide"] == 0) {
								echo "Non";
							} else {
								echo "Oui";
							}?>
						</td>
						<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteUser<?php echo $row['id']; ?>" name="<?php echo $row["id"]; ?>"></i></td>
					</tr>
				<?php }?>
			</tboby>
		</table>
	</div>
<?php	
}

if (!empty($code)) {
	//Supprime le code
	$query = "DELETE FROM code_statut WHERE code = $code;";
	$result = $link->query($query);

	$query = "SELECT * FROM code_statut;";
	$result = $link->query($query); ?>

	<div class="table-responsive">
		<table class="table table-striped" id="listCodeAcces">
			<thead>
				<tr>
					<th>Code</th>
					<th>Statut</th>
				</tr>
			</thead>
			<tboby>
				<?php while($row = $result->fetch_assoc()){	?>
					<tr>
						<td><?php echo $row["code"]; ?></td>
						<td><?php echo $row["statut"]; ?></td>
						<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteCode<?php echo $row['code']; ?>" name="<?php echo $row["code"]; ?>"></i></td>
					</tr>
				<?php } ?>
			</tboby>
		</table>
	</div>
<?php
}


if ($ajout) {
	if (!empty($codeAjout)) {
		$query = "INSERT INTO code_statut VALUES ($codeAjout, $statut);";
		$result = $link->query($query);
	}

	$query = "SELECT * FROM code_statut;";
	$result = $link->query($query); ?>

	<div class="table-responsive">
		<table class="table table-striped" id="listCodeAcces">
			<thead>
				<tr>
					<th>Code</th>
					<th>Statut</th>
				</tr>
			</thead>
			<tbody>
				<?php while($row = $result->fetch_assoc()){	?>
					<tr>
						<td><?php echo $row["code"]; ?></td>
						<td><?php echo $row["statut"]; ?></td>
						<td><i class="fa fa-trash-o fa-lg poubelle"  id="deleteCode<?php echo $row['code']; ?>" name="<?php echo $row["code"]; ?>"></i></td>
					</tr>
				<?php }
				?>
			</tboby>
		</table>
	</div>
<?php	
}


?>

<script>
	$("i[id^='deleteUser']").click(function() {
		var idUtilisateur = this.attributes["name"].value;

		$.ajax({
			url: "../ajax/confirmAdmin.php",
			type: 'POST',
			async: true,
			data : {
				idUtilisateur : idUtilisateur
			},
			success : function(code_html){
				$('#listUtilisateur').html(code_html);
			},
		});
	});

	$("i[id^='deleteCode']").click(function() {
		var code = this.attributes["name"].value;

		$.ajax({
			url: "../ajax/confirmAdmin.php",
			type: 'POST',
			async: true,
			data : {
				code : code
			},
			success : function(code_html){
				$('#listCodeAcces').html(code_html);
			},
		});
	});
</script>
