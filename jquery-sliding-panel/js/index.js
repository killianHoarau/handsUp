$(document).ready(function(){
	
	$('#dc-config').click(function(event){
			event.preventDefault();
	        event.stopPropagation();
			if ($('#dc-config-panel').is(":visible")){
				$('#dc-config-panel').slideUp(1000);
			}else{
				$('#dc-config-panel').slideDown(1000);
			}
		});		

		$('#btFermer').click(function(event){
			event.preventDefault();
	        event.stopPropagation();
			$('#dc-config-panel').slideUp(1000);
		});			
})
