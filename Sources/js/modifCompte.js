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
				$('#test').html(code_html);
				window.location.reload();
			},
		});
	}


});
