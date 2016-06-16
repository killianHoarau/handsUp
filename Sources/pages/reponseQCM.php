<?php
	session_start();
    $title="Répondre au QCM";
    include("header.php");
	include("../php/infoReponse.php");

?>

<section id="feature">
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2><?php echo utf8_encode($question["libelle"])	; ?></h2>
		</div>
		<div class="msform wow fadeInDown">
			<ul>
				<?php foreach ($reponses as $reponse) { ?>
					<li class="choix-reponse">
						<label><input type="radio" name="reponse" value="<?php echo $reponse["id"]; ?>"><?php echo $reponse["libelle"]; ?></label>
					</li>
				<?php } ?>
			</ul>
			<button id='btnValiderReponse' type="submit" class="next action-button">Valider</button>
		</div>
	</div>
</section>


<?php
	$nomScript="reponse";
    include("footer.php");
?>
