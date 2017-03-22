<?php

require_once "twitter.php";

$connection = Twitter::Instance();
$phrase = $_GET['phrase'];

if($phrase ==  null)
	die("Phrase cannot be null!");

$tweets = $connection->get("search/tweets", ["q" => "%23$phrase", "result_type" => "recent", "lang" => "pl", "count" => 5]);

echo 
//todo proper better array from responses
// $response = array();
// foreach ($tweets->statuses as $entry) {
	// $response[$entry->id] = array($entry->text, $entry->retweet_count, $entry->entities->hashtags);
// }

header('Content-Type: application/json');
echo json_encode($tweets->statuses);

?>