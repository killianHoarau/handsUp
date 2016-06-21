<?php
	$title="Cours";
	include("header.php");
	include("../php/infoCours.php");

?>

<section id="feature" class="row">
	<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			<a href="#menu" id="toggle"><img id="btQCM" src="../images/ico/question.png"></a>

			<div id="menu">
				<?php $i=0; if (!empty($questions[0])) { ?>
						<ul id="listQCM">
							<?php foreach ($questions as $question): ?>
								<li id="question-QCM">
									<?php if ($question['verrouille'] == 1): ?>
										<i id="<?php if($_SESSION['droit'] == 1) echo 'btnVerouiller'.$question['id']; ?>" name="<?php echo $question['id']; ?>" class="fa fa-lock" aria-hidden="true"></i>
										<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="1">
									<?php else: ?>
										<i id="<?php if($_SESSION['droit'] == 1) echo 'btnVerouiller'.$question['id']; ?>" name="<?php echo $question['id']; ?>" name="<?php echo $question['id']; ?>" class="fa fa-unlock" aria-hidden="true"></i>
										<input type="hidden" name="verrouille<?php echo $question['id']; ?>" value="0">
									<?php endif; ?>
									<a id="<?php
										if($question['verrouille'] == 0)echo 'btnRepondre'.$question['id'];?>"
										name="<?php echo $question['id']; ?>" class="a-QCM">QCM <?php echo utf8_encode($question['num']) ?>
									</a>
									<input type="hidden" id="ordre<?php echo $i; ?>" value="<?php if($i==0)echo"prems"; ?>"/>
								</li>
							<?php $i++; endforeach; ?>
						</ul>
				<?php } else{echo "Aucun QCM pour ce cours";} ?>
			</div>
		</div>

		<div  class="col-xs-8 col-sm-8 col-md- col-lg-">
			<div class="row center wow fadeInDown">
				<h2><?php echo utf8_encode($cour["libelle"]) ?></h2>
				<div class="msform suivre-cours" >
					<span class="cours-suivi" style="display:none;"><i class="fa fa-check-square-o" aria-hidden="true"></i>Cours suivi</span>
					<button id="btnSuivreCour" name="next" class="next action-button" style="display:none;">Suivre</button>
				</div>
			</div>
			<div class="row wow fadeInDown">
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
	#listQCM, #listQCM li{
		padding: 10px;
	}
	ul, li, li a {
	  list-style: none;
	  margin: 0;
	}
	#question-QCM a {
		cursor: pointer;
	  	color: #888;
	  	text-decoration: none;
	  	transition: all .2s;
	 	padding-left: 15px;
	}
	#question-QCM:hover, #question-QCM:focus, #question-QCM:hover > i.fa-lock, #question-QCM:focus > i.fa-lock{
		background: #c52d2f;
		color: #fff;
	}
	#question-QCM:hover > a.a-QCM, #question-QCM:focus > a.a-QCM{
		color: #fff;
	}
	#btQCM{
	  width: 80%;
	  height: 80%;
	}
</style>
<?php
	$nomScript="cours";
    include("footer.php");
?>
