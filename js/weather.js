$(document).ready(function() {
    const weatherSearch =  $('#btn-search-weather');
	const inputWeather = $('#input-search-weather');
	
	var myTmpl = $.templates("#weatherTemplate");

	function degToCompass(num) {
		var val = Math.floor((num / 22.5) + 0.5);
		var arr = ["N", "NNE", "NE", "ENE", "E", "ESE", "SE", "SSE", "S", "SSW", "SW", "WSW", "W", "WNW", "NW", "NNW"];
		return arr[(val % 16)];
	}
	
	weatherSearch.click(function() {
		var value = inputWeather.val();
		if(value !== ""){
			$.post("weather/address", { address: value }, function(data) {
				console.log(data);
				data.wind.deg = degToCompass(data.wind.deg);
				data.main.temp = (data.main.temp - 273).toFixed(2);
				data.main.temp_max = (data.main.temp_max - 273).toFixed(2);
				data.main.temp_min = (data.main.temp_min - 273).toFixed(2);
				var html = myTmpl.render(data);
				$("#weatherResult").html(html);
			});
		}
	});
});