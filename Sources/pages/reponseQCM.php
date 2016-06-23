<?php

    $title="Répondre au QCM";
    include("header.php");
	include("../php/infoReponse.php");

	if ($question["verrouille"] == 1) {
		header('Location: index.php');
	}

?>
<!-- Input hidden -->
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

<!-- Erreur -->
<section id="feature" class="verrouille">
	<p>Cette question a été vérrouillée, vous ne pouvez plus y répondre.</p>
</section>
<section id="feature" class="dejaRep">
	<p>Vous avez déja répondu à cette question, cliquez sur Annuler pour retourner au cours.</p>
</section>


<section id="feature">
	<div class="container">
	   <div class="wow fadeInDown">
	   		<div class="row center title-reponse">
				<h2><?php echo utf8_encode($question["libelle"]); ?></h2>
			</div>
			<div id="contentReponse" class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php foreach ($reponses as $reponse) { ?>
						<div class="row">
							<div  class="checkbox checkbox-info checkbox-circle">
								<input type="radio" id="radio_<?php echo $reponse["id"]; ?>" name="reponse" value="<?php echo $reponse["id"]; ?>">
								<label for="radio_<?php echo $reponse["id"]; ?>"><?php echo $reponse["libelle"]; ?></label>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>

			<!-- Reponse affichée -->
			<div id="reponse"></div>
			<div id="diagramme" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; display: none;"></div>
		</div>

		<div class="msform wow fadeInDown">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div id="bntReponse">
					<?php if ($_SESSION["droit"] == 1): ?>
						<div class="row">
							<button id='btnShowReponse' class=" boutons-reponse next action-button">Afficher la réponse</button>
						</div>
					<?php else: ?>
						<div class="row">
							<button id='btnValiderRetour' class=" boutons-reponse next action-button">Valider</button>
						</div>

						<div class="row">
							<button class="boutons-reponse next action-blue" <?php if($_GET['ordre']=="prems") { ?> data-toggle="modal" data-target="#myModal" <?php }else {?> id='btnValiderSuivant' <?php } ?>>
								Suivante
							</button>
						</div>

					<?php endif; ?>
				</div>
				<div class="row">
					<button class="boutons-reponse next oubli-button" onclick="window.location.href='cours.php?idCours=<?php echo $question['idCours']; ?>'">Anuler</button>
				</div>
			</div>

		</div>

		<div id="nbrRep" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</div>
</section>

<script type="text/javascript">
	adresseIP = '<?php echo $_SERVER["REMOTE_ADDR"]; ?>';
</script>
<?php
	$nomScript="reponse";
    include("footer.php");
?>
