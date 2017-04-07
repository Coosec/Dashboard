$(document).ready(function() {
	const tweetsTemplate = $('#tweetsTemplate');
	const inputSearch = $('#input-search');
	$('#btn-search').click(function() {
		var countOftweets = parseInt($('#sel1 option:selected').text());

		$('#searchResults').html('');
		$('#preloader').show();
		$('.search').css('opacity','0.1');

		var value = inputSearch.val();
		if(value !== ""){
			setTimeout(showCode,2000,value,countOftweets);
		}
	});
});

function showCode(value,countOftweets){
	var myTmpl = $.templates("<div class='tweet_item'>" +
		"<div class='background'> <img src='{{:user.profile_background_image_url}}'/></div><div class='user'>" +
		" <img src='{{:user.profile_image_url}}'/> <b> {{:user.name}}</b>" +
		", followers: {{:user.followers_count}}<br/>" +
		"</div><div class='description'><blockquote> {{:text}}<cite>{{:created_at}}</cite></blockquote></div></div>");


	$.post("twitter/tweets", { phrase: value, countOfTweets: countOftweets  }, function(data) {
		var html = myTmpl.render(data);
		$("#searchResults").html(html);
		$('#preloader').hide();
		$('.search').css('opacity','1');


	})};