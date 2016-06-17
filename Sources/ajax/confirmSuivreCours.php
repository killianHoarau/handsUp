<?php
session_start();

$idCours = $_POST["idCours"];
$idUtilisateur = $_POST["idUtilisateur"];
$suivreCours = $_POST["suivreCours"];

$verrouillerQuestion = $_POST["verrouillerQuestion"];
$idQuestion = $_POST["idQuestion"];
$verrouille = $_POST["verrouille"];

$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

if ($suivreCours) {
	$query = "INSERT INTO suivre_cours VALUES ($idUtilisateur, $idCours);";
	$result = $link->query($query);
}

if ($verrouillerQuestion) {
	$query = "UPDATE question SET verrouille = $verrouille WHERE id = $idQuestion;";
	$result = $link->query($query);

	$query = "SELECT * FROM question WHERE idCours = $idCours";
	$result = $link->query($query);

	$questions = array(array());
	$i = 0;

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){
			$questions[$i]['id'] = $row['id'];
			$questions[$i]['libelle'] = $row['libelle'];
			$questions[$i]['verrouille'] = $row['verrouille'];
			$questions[$i]['num'] = $i+1;

		$i++;
		}
	}

	foreach ($questions as $question): ?>
		<li id="question-QCM">
			<?php if ($question['verrouille'] == 1): ?>
				<i id="<?php if($_SESSION['droit'] == 1) echo 'btnVerouiller'.$question['id']; ?>" name="<?php echo $question['id']; ?>" class="fa fa-lock" aria-hidden="true"></i>
				<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="1">
			<?php else: ?>
				<i id="<?php if($_SESSION['droit'] == 1) echo 'btnVerouiller'.$question['id']; ?>" name="<?php echo $question['id']; ?>" class="fa fa-unlock" aria-hidden="true"></i>
				<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="0">
			<?php endif; ?>
			<a id="<?php
				if($question['verrouille'] == 0)echo 'btnRepondre'.$question['id'];?>"
				name="<?php echo $question['id']; ?>" class="a-QCM">QCM <?php echo utf8_encode($question['num']) ?>
			</a>
		</li>
	<?php endforeach;
}
?>

<script>
$("i[id^='btnVerouiller']").click(function() {
	var idQuestion = this.attributes["name"].value;
	var verrouille = document.getElementsByName('verrouille'+idQuestion)[0].value;
	var verrouillerQuestion = true;

	if (verrouille == 1) {
		verrouille = 0;
	}else {
		verrouille = 1;
	}
	$.ajax({
		url: "../ajax/confirmSuivreCours.php",
		type: 'POST',
		async: true,
		data : {
			idCours : idCours,
			idQuestion : idQuestion,
			verrouille : verrouille,
			verrouillerQuestion : verrouillerQuestion
		},
		success : function(code_html){
			$('#listQCM').html(code_html);
			// alert(code_html);
		},
	});

});

$("a[id^='btnRepondre']").click(function() {
	var idQuestion = this.attributes["name"].value;
	document.location = "reponseQCM.php?idQuestion="+idQuestion;

});
</script>
