<?php
	session_start();
    $title="Répondre au QCM";
    include("header.php");
	include("../php/infoReponse.php");

	if ($question["verrouille"] == 1) {
		header('Location: index.php');
	}

?>
<input type="hidden" name="idCours" value="<?php echo $question['idCours']; ?>">
<input type="hidden" name="idQuestion" value="<?php echo $question['id']; ?>">
<input type="hidden" name="numQuestion" value="<?php echo $question['numero']; ?>">

<section id="feature">
	<div class="container">
	   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown">
	   		<div class="center">
				<h2><?php echo utf8_encode($question["libelle"]); ?></h2>
			</div>
<?php 
			foreach ($reponses as $reponse) { 
?>
			<div class="row">
				<div  class="checkbox checkbox-info checkbox-circle">
					<input type="radio" id="radio_<?php echo $reponse["id"]; ?>" name="reponse" value="<?php echo $reponse["id"]; ?>">
					<label for="radio_<?php echo $reponse["id"]; ?>"><?php echo $reponse["libelle"]; ?></label>
				</div>
			</div>
<?php } ?>
		</div>
<<<<<<< HEAD
		<div id="contentReponse" class="msform wow fadeInDown">
			<ul>
				<?php foreach ($reponses as $reponse) { ?>
					<li class="choix-reponse">
						<label><input type="radio" name="reponse" value="<?php echo $reponse["id"]; ?>"><?php echo $reponse["libelle"]; ?></label>
					</li>
				<?php } ?>
			</ul>
			<a href="cours.php?idCours=<?php echo $question['idCours']; ?>" class="next oubli-button">Retour au cours</a>
			<?php if ($_SESSION["droit"] == 1): ?>
				<a id='btnShowReponse' type="submit" class="next action-button">Afficher la réponse</a>
			<?php else: ?>
				<a id='btnValiderSuivant' type="submit" class="next action-button">Valider et passer à la question suivante</a>
				<a id='btnValiderRetour' type="submit" class="next action-button">Valider et retourner au cours</a>
			<?php endif; ?>
=======
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 msform wow fadeInDown">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<a href="cours.php?idCours=<?php echo $question['idCours']; ?>" class="next oubli-button">Anuler</a>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<a id='btnValiderRetour' type="submit" class="next action-button">Valider</a>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<a id='btnValiderSuivant' type="submit" class="next action-blue">Valider et Suivante</a>
			</div>
>>>>>>> 35afa5b1d957a309c935d8e3a7bc8161790297f2
		</div>
	</div>
</section>


<?php
	$nomScript="reponse";
    include("footer.php");
?>
