$('#btnSaveInfo').click(function(){

	var login = document.getElementById('inputLogin');
	var email = document.getElementById("inputEmail");

	var valid = true;

	if(login.value.length === 0){
		login.style.border = "1px solid red";
		var valid = false;
	}
	if(email.value.length === 0){
		email.style.border = "1px solid red";
		var valid = false;
	}

	if(valid){
		$.ajax({
			url: "../ajax/confirmModifCompte.php",
			type: 'POST',
			async: true,
			data : {
				login : login.value,
				email : email.value
			},
			success : function(code_html){
				console.log(code_html);
				console.log("\"10\"");
				if(code_html == "\"10\"")	//si le login ou l'mail n'existe pas deja en base (valide = true et erreur = 0) : valide.erreur = "10"
					window.location.reload();
				else if(code_html == "\"1\"")		//si le login existe en base : erreur = "1"
				{
					$('#inputLogin').tooltip({
						title : "Login déja utilisé",
						placement: "bottom",
						trigger: "manual"
					});
					$('#inputLogin').tooltip('show');
				}
				else if(code_html == "\"2\"")		//si le login existe en base : erreur = "2"
				{
					$('#inputEmail').tooltip({
						title : "Email déja utilisé",
						placement: "bottom",
						trigger: "manual"
					});
					$('#inputEmail').tooltip('show');
				}
			},
		});
	}


});
