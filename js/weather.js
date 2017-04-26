$(document).ready(function() {
    const weatherSearch =  $('#btn-search-weather');
	const inputWeather = $('#input-search-weather');
	
	var myTmpl = $.templates("#weatherTemplate");

	weatherSearch.click(function() {
		var value = inputWeather.val();
		if(value !== ""){
			$.post("weather/address", { address: value }, function(data) {
				console.log(data);
				var html = myTmpl.render(data);
				$("#weatherResult").html(html);
			});
		}
	});
});