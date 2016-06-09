$(document).ready(function(){
	$('#statutInscription').toggle();
	$('#statutConnexion').toggle();
	$('#statutRecuperation').toggle();
	$('#erreurVide').hide();	
	$('#connectVide').hide();	
	$('#recupVide').hide();	
	$('#formCompteOublie').toggle();
	$('#recupSpan').hide();
});
var inscriptionToggled = false;
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
						$('#statutInscription').html(code_html);
						if (!inscriptionToggled)
						{
							$('#statutInscription').toggle(1000, "swing");
							inscriptionToggled = true;
						}
				},
			});
		}
		if(!valid)
		{
			$('#erreurVide').show();
			if (!inscriptionToggled)
			{
				$('#statutInscription').toggle(1000, "swing");
				inscriptionToggled = true;
			}
		}
	});
$("input").click(function()
{
	this.style.border = "1px solid #ccc";
});

var connexionToggled = false;
$('#btnConnexion').click(function(){
	var login = document.getElementsByName('login')[1];
	var mdp = document.getElementsByName("mdp")[1];
	
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
							window.location.assign("http://localhost:8080/handsup/sources/pages/index.php");
						else
						{
							if (!connexionToggled)
							{
								$('#connectVide').show();
								$('#statutConnexion').toggle(1000, "swing");
								connexionToggled = true;
							}
						}
				},
			});
		}
	if(!valid)
		{
			$('#connectVide').show();
			if (!connexionToggled)
			{
				$('#statutConnexion').toggle(1000, "swing");
				connexionToggled = true;
			}
		}
	// alert(login+mdp);
	//alert("test");
});
$('#btnOubli').click(function(){
	$('#formCompteOublie').toggle(500, "swing")
	$('#recupSpan').show();
	
})

//Au click sur le bouton de recuperation
$('#btnRecuperation').click(function(){
	var login = document.getElementsByName('login')[2];
	var email = document.getElementsByName("email")[1];
	var valid = true;
	if(login.value.length === 0){
			login.style.border = "1px solid red";
		}
	if(email.value.length === 0){
			email.style.border = "1px solid red";
		}
	if(login.value.length === 0 && email.value.length === 0)
		valid = false;
	if(!valid)
		{
			$('#connectVide').show();
			if (!connexionToggled)
			{
				$('#statutConnexion').toggle(1000, "swing");
				connexionToggled = true;
			}
		}
	else
	{
		alert("ca va chier");
	}
})
