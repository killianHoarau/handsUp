<?php
	session_start();
    $title="Cours";
    include("header.php");
	include("../php/infoCours.php");
?>

<section id="feature" >
	<div class="container">
	   <div class=" row wow fadeInDown">
			<div class="col-lg-4 title-cours">
				<h2>Liste des QCM</h2>
			</div>
			<div class="col-lg-8 msform" style="margin-top: 0;">
				<div class="title-cours">
					<h2><?php echo utf8_encode($cour["libelle"]) ?></h2>
				</div>
				<div class="right">
						<span class="cours-suivi"><i class="fa fa-check-square-o" aria-hidden="true"></i>Cours suivi</span>
						<button id="btnSuivreCour" name="next" class="next action-button">Suivre</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<ul id="listQCM">
					<?php foreach ($questions as $question): ?>
						<li><?php if ($question['verrouille'] == 1): ?>
								<i class="fa fa-lock" aria-hidden="true"></i>
								<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="1">
							<?php else: ?>
								<i class="fa fa-unlock" aria-hidden="true"></i>
								<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="0">
							<?php endif; ?>
							<button id="<?php if($_SESSION['droit'] == 1){echo 'btnVerouiller'.$question['id'];} else if($_SESSION['droit'] != 1 && $question['verrouille'] == 0){echo 'btnRepondre'.$question['id'];} ?>" name="<?php echo $question['id']; ?>">QCM <?php echo utf8_encode($question['num']) ?></button>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>
			<div class="col-lg-8">
				<?php echo utf8_encode($cour["description"]) ?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	var droit = '<?php echo $_SESSION["droit"];?>';
	var idUtilisateur = '<?php echo $_SESSION["id"];?>';
	var droit = '<?php echo $_SESSION["droit"];?>';
	var idCours = '<?php echo $cour["id"];?>';
	var suivre = '<?php echo $suivre;?>';
</script>
<?php
	$nomScript="cours";
    include("footer.php");
?>
