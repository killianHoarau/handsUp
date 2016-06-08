<?php
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
<form id="signIn" class="msform">
<!-- fieldsets -->
  <fieldset>
  	<input type="text" name="nom" placeholder="Nom" />
    <input type="text" name="email" placeholder="Email" />
    <input type="password" name="mdp" placeholder="Mot De Passe" />
    <input type="password" name="cpass" placeholder="Confirmation" />
    <input type="password" name="code" placeholder="Code Etudiant / Enseignant" />
    <input type="button" name="next" class="next action-button" value="Inscription" />
  </fieldset>
  </form>
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
</div>


</form>
<?php
	include("footer.php");
?>
<script>
	$('#signIn').click(function(){
		alert('test');
		
	});
</script>