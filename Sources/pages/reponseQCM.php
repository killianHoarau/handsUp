<?php
	session_start();
    $title="Répondre au QCM";
    include("header.php");
	include("../php/infoReponse.php");

?>
<input type="hidden" name="idCours" value="<?php echo $question['idCours']; ?>">
<input type="hidden" name="idQuestion" value="<?php echo $question['id']; ?>">
<input type="hidden" name="numQuestion" value="<?php echo $question['numero']; ?>">
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Attention!</h4>
        </div>
        <div class="modal-body">
          <p>La question actuelle sera validée avant de passer à la suivante.</p>
        </div>
        <div class="modal-footer msform">
    	  <a   class="next action-button" <?php if($_GET['ordre']=="prems") { ?> id='btnValiderSuivant' <?php } ?> >Continuer</a>
    	  <a data-dismiss="modal" class="plusieursBtn next oubli-button">Anuler</a>
        </div>
      </div>
    </div>
  </div>
<section id="feature">
	<div class="container">
	   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown">
	   		<div class="center">
				<h2><?php echo utf8_encode($question["libelle"]); ?></h2>
			</div>
			<div id="contentReponse">
				<?php foreach ($reponses as $reponse) { ?>
				<div class="row">
					<div  class="checkbox checkbox-info checkbox-circle">
						<input type="radio" id="radio_<?php echo $reponse["id"]; ?>" name="reponse" value="<?php echo $reponse["id"]; ?>">
						<label for="radio_<?php echo $reponse["id"]; ?>"><?php echo $reponse["libelle"]; ?></label>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id="reponse"></div>
			<div id="diagramme" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 msform wow fadeInDown">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<a href="cours.php?idCours=<?php echo $question['idCours']; ?>" class="next oubli-button">Anuler</a>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<a class="next action-blue" <?php if($_GET['ordre']=="prems") { ?>
														data-toggle="modal" data-target="#myModal"
											<?php }else {?> id='btnValiderSuivant' <?php } ?>
				>Suivante</a>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<a id='btnValiderRetour' class="next action-button">Valider</a>
			</div>
		</div>
	</div>
</section>


<?php
	$nomScript="reponse";
    include("footer.php");
?>
