<?php
  $title="Inscription | Connexion";
	include("header.php");
?>

<br>
<div class="container">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<div class="col-lg-12">
				<div class="titleprghp">
					<span class="prg">Inscription</span> 
				</div>
			</div>
			<div id="signIn" class="msform" method='POST'>
				<!-- fieldsets -->
				<fieldset>
					<input type="text" name="login" placeholder="Login"/>
					<input type="email" name="email" placeholder="Email"/>
					<input type="password" name="mdp" placeholder="Mot De Passe"/>
					<input type="password" name="cmdp" placeholder="Confirmation"/>
					<input type="text" name="code" placeholder="Code Etudiant / Enseignant"/>
					<input id='btnInscription' type="submit" name="next" class="next action-button" value="Inscription"/>
				</fieldset>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="col-lg-12">
				<div class="titleprghp">
					<span class="prg">Connexion</span> 
				</div>
			</div>
			<div class="formConnexion">
				<form action="../php/confirmLogin.php" method="POST" class="msform">
					<!-- fieldsets -->
					<fieldset>
						<input type="text" name="login" placeholder="Login" />
						<input type="password" name="mdp" placeholder="Mot De Passe" />
						<input type="submit" name="next" class="next action-button" value="Connexion" />
					</fieldset>
				</form>
			</div>
		</div>	  
	</div>
	<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Compte créé<br />Connectez-vous !</h4>
		  </div>
		</div>
	  </div>
	</div>
</div>

<?php
	include("footer.php");
?>
<script>
	$('#btnInscription').click(function(){
		var login = document.getElementsByName('login')[0];
		var email = document.getElementsByName("email")[0];
		var mdp = document.getElementsByName("mdp")[0];
		var cmdp = document.getElementsByName("cmdp")[0];
		var code = document.getElementsByName("code")[0];
		
		var valid = true;
		if(login.value.length === 0){
			login.style.border = "1px solid red";
			var valid = false;
		}
		if(email.value.length === 0){
			email.style.border = "1px solid red";
			var valid = false;
		}
		if(mdp.value.length === 0){
			mdp.style.border = "1px solid red";
			var valid = false;
		}
		if(cmdp.value.length === 0){
			cmdp.style.border = "1px solid red";
			var valid = false;
		}
		if(code.value.length === 0){
			code.style.border = "1px solid red";
			var valid = false;
		}
		
		if(valid)
		{
			$.ajax({
				url: "../ajax/confirmInscription.php",
				type: 'POST',
				async: true,
				data : {
					login : login.value,
					email : email.value,
					mdp : mdp.value,
					cmdp : cmdp.value,
					code : code.value
				},
				success : function(code_html){ // code_html contient le HTML renvoyé
							console.log("test");
							$('#myModal').css('opacity','1'); //ok
							$('#myModal').toggle();
				},
			});
		}
	});
	$("input").click(function()
	{
		this.style.border = "1px solid #ccc";
	})
	$("button[class='close']").click(function(){
		$('#myModal').css('opacity','0');
		$('#myModal').toggle();
	})
</script>