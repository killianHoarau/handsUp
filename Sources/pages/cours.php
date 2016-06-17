<?php
	session_start();
    $title="Cours";
    include("header.php");
	include("../php/infoCours.php");
?>
<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      /* Important styles */
	#toggle {
	  display: block;
	  width: 28px;
	  height: 30px;
	  margin: 30px auto 10px;
	}

	#toggle.on + #menu {
	  opacity: 1;
	  visibility: visible;
	}

	/* menu appearance*/
	#menu {
	  position: relative;
	  color: #999;
	  width: 200px;
	  padding: 10px;
	  margin: auto;
	  font-family: "Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", "Trebuchet MS", Verdana, "Verdana Ref", sans-serif;
	  text-align: center;
	  border-radius: 4px;
	  background: white;
	  box-shadow: 0 1px 8px rgba(0,0,0,0.05);
	  /* just for this demo */
	  opacity: 0;
	  visibility: hidden;
	  transition: opacity .4s;
	  z-index: 10;
	}
	#menu:after {
	  position: absolute;
	  top: -15px;
	  left: 95px;
	  content: "";
	  display: block;
	  border-left: 15px solid transparent;
	  border-right: 15px solid transparent;
	  border-bottom: 20px solid white;
	}
	ul, li, li a {
	  list-style: none;
	  display: block;
	  margin: 0;
	  padding: 0;
	}
	li a {
	  padding: 5px;
	  color: #888;
	  text-decoration: none;
	  transition: all .2s;
	}
	li a:hover,li a:focus {  background: #1ABC9C;  color: #fff;}

	#btQCM{
	  width: 80%;
	  height: 80%;
	}
</style>
<section id="feature" class="row">
	<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			<a href="#menu" id="toggle"><img id="btQCM" src="../images/ico/question.png"></a>

			<div id="menu">
				<?php if (!empty($questions[0])) { ?>
						<ul id="listQCM">
							<?php foreach ($questions as $question): ?>
								<li>
								<?php if ($question['verrouille'] == 1): ?>
										<i class="fa fa-lock" aria-hidden="true"></i>
										<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="1">
									<?php else: ?>
										<i class="fa fa-unlock" aria-hidden="true"></i>
										<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="0">
									<?php endif; ?>
									<button id="<?php
													if($_SESSION['droit'] == 1) echo 'btnVerouiller'.$question['id'];
													else if($_SESSION['droit'] != 1 && $question['verrouille'] == 0)echo 'btnRepondre'.$question['id'];
												?>"
											name="<?php echo $question['id']; ?>">
												QCM <?php echo utf8_encode($question['num']) ?>
									</button>
								</li>
							<?php endforeach; ?>
						</ul>
				<?php } else{echo "Aucun QCM pour ce cours";} ?>
			</div>
		</div>

		<div  class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<div class="row">
				<div  class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<p>
						<h2><?php echo utf8_encode($cour["libelle"]) ?></h2>
					</p>
				</div>
				<div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<span class="cours-suivi"><i class="fa fa-check-square-o" aria-hidden="true"></i>Cours suivi</span>
					<button id="btnSuivreCour" name="next" class="next action-button">Suivre</button>
				</div>
			</div>
			<div class="row">
				<div  class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<?php echo utf8_encode($cour["description"]) ?>
				</div>
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
