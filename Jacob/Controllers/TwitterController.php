<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Controllers;
use Jacob\Core\Controller;
use Jacob\Helper\Twitter;
class TwitterController extends Controller
{
    protected $connection;

    public function indexAction()
    {
           $this->view->render();
    }

    public function tweetsAction()
    {
        $this->view->setDefaultContentType('application/json');
        $fields = $this->_request->getPost();
        $countOfTweets = $fields['countOfTweets'];
        if(!isset($fields['phrase'])) {
            $response = 'Podaj cokolwiek!';
        } else {
         try {
             $this->setTwitterGranted();
             $phrase = $fields['phrase'];
             $response = $this->connection->get("search/tweets", ["q" => "%23$phrase", "result_type" => "recent", "lang" => "pl", "count" => $countOfTweets])->statuses;
         } catch(\Exception $e) {
             $response = $e->getMessage();
         }
        }echo json_encode($response);
    }

    private function setTwitterGranted()
    {
        $this->connection = Twitter::Instance();

    }


}