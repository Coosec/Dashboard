$(document).ready(function() {
    const googleSearch =  $('#btn-search-google');
	const inputGoogle = $('#input-search-google');
	const mapCanvas = $('#gmap');
	
	googleSearch.click(function() {
		var value = inputGoogle.val();
		if(value !== ""){
			$.post("googlemaps/address", { address: value }, function(data) {
				var template = $.templates("<p><strong>Adress: " + data.formattedAddress + "</strong><p>"
				+ "<img src=\""+ data.src + "\">");
				mapCanvas.html(template);
			});
		}
	});
});
