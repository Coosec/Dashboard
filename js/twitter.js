$(document).ready(function() {
    const twitterSearch =  $('#btn-search');
	const tweetsTemplate = $('#tweetsTemplate');
	const inputSearch = $('#input-search');
	
	var myTmpl = $.templates("<li><div style='tweet_item'>Użytkownik:<b> {{:user.name}} </b> Liczba followersów: {{:user.followers_count}}<br/> Avatar: <img src='{{:user.profile_image_url}}'/></div><label>Treść:</label> {{:text}}</li>");
	
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
