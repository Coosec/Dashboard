$(document).ready(function() {
    const spotifySearch =  $('#btn-search-spotify');
	const inputSpotify = $('#input-search-spotify');
	
    var myTmpl = $.templates("#spotifyResults");

	spotifySearch.click(function() {
		var value = inputSpotify.val();
		if(value !== ""){
			$.post("spotify/search", { artist: value }, function(data) {
				console.log(data);
                var html = myTmpl.render(data);
                // $.each(data.artists.items, function(index, object_value) {
                //     html += myTmpl.render(object_value);
                // });
		        $("#searchResults").html(html);
                console.log(data);
			});
		}
	});
});


		