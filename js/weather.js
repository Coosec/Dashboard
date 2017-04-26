$(document).ready(function() {
    const weatherSearch =  $('#btn-search-weather');
	const inputWeather = $('#input-search-weather');
	const mapCanvas = $('#gmap');
	
	weatherSearch.click(function() {
		var value = inputWeather.val();
		if(value !== ""){
			$.post("weather/address", { address: value }, function(data) {
				var template = $.templates("<p><strong>Temperatura to: " + data.temperature + "</strong><p>");
				mapCanvas.html(template);
			});
		}
	});
});
