$(document).ready(function() {
	// activate button library for specified elements
	$( "button, input:submit, a", ".txbuttons" ).button();

	// enable individual buttons (button id + function)
	$("#txbutton").click(ajaxTx);
	// $("#js_executeRenumber").click(renumber);

});



function ajaxTx () {
	// alert("trace");
	// exit;
	textToTranslate = $('#txTextarea').val();
	// alert($('#txTextarea').val());
	// textToTranslate = 'cheese';
	builtUrl = 'index.php?ajax=1&tx='+textToTranslate;
	
	// $("#progressAccordionContent").html("<p>POSTing "+action+" to webservice</p><p>Payload: "+escapeXML(GETStringToSend)+"</p>");
	// console.log("senditRemote() builtUrl: "+builtUrl);
	
	$.ajax({
			type: "GET",
			url: builtUrl,
			async: true,
			error: function (XMLHttpRequest,textStatus,errorThrown){
				$("#warningBar").text("communication error, try again??");
				alert("errer");
			},
			success: function(response,status){
				$("#txText").text(response);
				// $("#resultlayer").show(500);
				$("#resultlayer").fadeIn('slow');
				
			}
		});
}