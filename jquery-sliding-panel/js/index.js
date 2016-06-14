$(document).ready(function(){
	for(i=0; i<2; i++){
		$('#dc-config0').click(function(event){
			event.preventDefault();
	        event.stopPropagation();
			if ($('#dc-config-panel0').is(":visible")){
				$('#dc-config-panel0').slideUp(1000);
			}else{
				$('#dc-config-panel0').slideDown(1000);
			}
		});	

		$('#dc-config1').click(function(event){
			event.preventDefault();
	        event.stopPropagation();
			if ($('#dc-config-panel1').is(":visible")){
				$('#dc-config-panel1').slideUp(1000);
			}else{
				$('#dc-config-panel1').slideDown(1000);
			}
		});	
		/*
		$('#dc-config'+i).click(function(event){
			event.preventDefault();
	        event.stopPropagation();
			if ($('#dc-config-panel'+i).is(":visible")){
				$('#dc-config-panel'+i).slideUp(1000);
			}else{
				$('#dc-config-panel'+i).slideDown(1000);
			}
		});	
		*/
	}		
})
