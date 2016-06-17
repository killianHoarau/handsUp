$(document).ready(function(){
	var isset = document.getElementById("emailConf").value+" ";
	if (isset == 1){
		$('#firstConnection').animate({
							height: 'toggle'
						});
		setTimeout(function(){
			$('#firstConnection').animate({
							height: 'toggle'
			});
			}, 2000);	
	}
	//else
		//alert("no");

});

