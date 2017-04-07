$(document).ready(function() {
    const googleSearch =  $('#btn-search-google');
	const inputGoogle = $('#input-search-google');
	
	googleSearch.click(function() {
		var value = inputGoogle.val();
		if(value !== ""){
			$.post("googlemaps/address", { address: value }, function(data) {
				//var html = myTmpl.render(data);
				console.log(data);
				//$("#searchResults").html(html);
			});
		}
	});
});
