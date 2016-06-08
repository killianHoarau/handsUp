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
							$('#myModal').css('opacity','1'); //ok
							$('#myModal').toggle();
				},
			});
		}
		else{
			$('#erreur').css('opacity','1'); //ok
			$('#erreur').toggle();
		}
	});
$("input").click(function()
{
	this.style.border = "1px solid #ccc";
})
$("button[class='close']").click(function(){
	$('#myModal').css('opacity','0');
	$('#myModal').toggle();
	$('#erreur').css('opacity','0');
	$('#erruer').toggle();
	$('#oubli').css('opacity','0');
	$('#oubli').toggle();
})

$('#btnOubli').click(function(){
		alert("oubli");
		$('#oubli').css('opacity','1'); //ok
		$('#oubli').toggle();
});