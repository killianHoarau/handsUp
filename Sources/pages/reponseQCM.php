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
		</div>
	</div>
</section>


<?php
	$nomScript="reponse";
    include("footer.php");
?>
