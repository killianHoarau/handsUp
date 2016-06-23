var inscriptionToggled = false;
$('#btnInscription').click(function(){
		var login = document.getElementsByName('loginI')[0];
		var email = document.getElementsByName("emailI")[0];
		var mdp = document.getElementsByName("mdpI")[0];
		var cmdp = document.getElementsByName("cmdpI")[0];
		var code = document.getElementsByName("codeI")[0];
		
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
						$('#statutInscription').html(code_html);
						if (!inscriptionToggled)
						{
							$('#statutInscription').animate({
								height: 'toggle'
							});
							inscriptionToggled = true;
						}
				},
			});
		}
		if(!valid)
		{
			if (!inscriptionToggled)
			{
				$('#statutInscription').animate({
					height: 'toggle'
				});
				inscriptionToggled = true;
			}
		}
	});
$("input").focus(function()
{
	this.style.border = "1px solid #ccc";
});

var connexionToggled = false;
$('#btnConnexion').click(function(){
	var login = document.getElementsByName('loginC')[0];
	var mdp = document.getElementsByName("mdpC")[0];
	
	var valid = true;
	if(login.value.length === 0){
		login.style.border = "1px solid red";
		valid = false;
	}
	if(mdp.value.length === 0){
		mdp.style.border = "1px solid red";
		valid = false;
	}
	if(valid)
		{
			
			$.ajax({
				url: "../php/confirmLogin.php",
				type: 'POST',
				async: true,
				data : {
					login : login.value,
					mdp : mdp.value
				},
				success : function(code_html){ // code_html contient le HTML renvoyé
						$('#statutConnexion').html(code_html);
						if(code_html=='1')
							window.location.assign("../pages/index.php");
						else
						{
							if (!connexionToggled)
							{
								$('#connectVide').show();
								$('#statutConnexion').animate({
									height: 'toggle'
								});
								connexionToggled = true;
							}
						}
				},
			});
		}
	if(!valid)
		{
			if (!connexionToggled)
			{
				$('#statutConnexion').animate({
					height: 'toggle'
				});
				connexionToggled = true;
			}
		}
});
$('#btnOubli').click(function(){
	$('#formCompteOublie').show();
	$('#recupSpan').show();
	
})

//Au click sur le bouton de recuperation
$('#btnRecuperation').click(function(){
	var email = document.getElementsByName("emailR")[0];
	var valid = true;
	if(email.value.length === 0){
			email.style.border = "1px solid red";
			valid = false;
		}
	if(!valid)
		{
			if (!connexionToggled)
			{
				$('#statutConnexion').animate({
					height: 'toggle'
				});
				connexionToggled = true;
			}
		}
	else
	{
		$.ajax({
				url: "../ajax/envoiRecuperation.php",
				type: 'POST',
				async: true,
				data : {
					email : email.value
				},
				success : function(code_html){ // code_html contient le HTML renvoyé
						$('#statutInscription').html(code_html);
						if (!inscriptionToggled)
						{
							$('#statutInscription').animate({
								height: 'toggle'
							});
							inscriptionToggled = true;
						}
				},
			});
	}
});
$('#btnAnnul').click(function(){
	$('#formCompteOublie').animate({
		height: 'toggle'
	});
});
