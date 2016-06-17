<?php
	session_start();
    $title="Répondre au QCM";
    include("header.php");
	include("../php/infoReponse.php");

?>
<input type="hidden" name="idCours" value="<?php echo $question['idCours']; ?>">
<input type="hidden" name="idQuestion" value="<?php echo $question['id']; ?>">
<input type="hidden" name="numQuestion" value="<?php echo $question['numero']; ?>">

<section id="feature">
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2><?php echo utf8_encode($question["libelle"]); ?></h2>
		</div>
		<div class="msform wow fadeInDown">
			<ul>
				<?php foreach ($reponses as $reponse) { ?>
					<li class="choix-reponse">
						<label><input type="radio" name="reponse" value="<?php echo $reponse["id"]; ?>"><?php echo $reponse["libelle"]; ?></label>
					</li>
				<?php } ?>
			</ul>
			<a href="cours.php?idCours=<?php echo $question['idCours']; ?>" class="next oubli-button">Retour au cours</a>
			<a id='btnValiderSuivant' type="submit" class="next action-button">Valider et passer à la question suivante</a>
			<a id='btnValiderRetour' type="submit" class="next action-button">Valider et retourner au cours</a>

		</div>
	</div>
</section>


<?php
	$nomScript="reponse";
    include("footer.php");
?>
