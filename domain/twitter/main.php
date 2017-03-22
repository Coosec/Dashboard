<?php

require_once "twitter.php";

$connection = Twitter::Instance();

$tweets = $connection->get("search/tweets", ["q" => "%23poland", "result_type" => "recent", "lang" => "pl", "count" => 5]);

$response = array();
foreach ((array)$tweets->statuses as $entry) {
	$response[$entry->id] = array($entry->text, $entry->retweet_count, $entry->entities->hashtags);
}

header('Content-Type: application/json');
echo json_encode($response);

?>