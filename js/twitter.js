$(document).ready(function() {
    const twitterSearch =  $('#btn-search');
	const tweetsTemplate = $('#tweetsTemplate');
	const inputSearch = $('#input-search');
	
	var myTmpl = $.templates("<li><label>Treść:</label> {{:text}}</li>");
	
	twitterSearch.click(function() {
		var value = inputSearch.val();
		if(value !== ""){
			$.get("domain/twitter/main.php", { phrase: value }, function(data) {
				var html = myTmpl.render(data);
				console.log(data);
				$("#searchResults").html(html);
			});
		}
	});
});
