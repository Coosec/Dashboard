$(document).ready(function() {
    const weatherSearch =  $('#btn-search-weather');
	const inputWeather = $('#input-search-weather');
	//const mapCanvas = $('#gmap');
	
	weatherSearch.click(function() {
		var value = inputWeather.val();
		console.log("click");
		console.log(value);
		if(value !== ""){
			$.post("weather/address", { address: value }, function(data) {
				console.log(data.temperature);
				//var template = $.templates("<p><strong>Temperatura to: " + data.temperature + "</strong><p>");
				//mapCanvas.html(template);
			});
		}
	});
});
