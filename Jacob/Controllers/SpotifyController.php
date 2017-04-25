<?php

namespace Jacob\Controllers;
use Jacob\Core\Controller;
use Libs\External\Spotify as SpotifyApi;

class SpotifyController extends Controller {
    
    public function indexAction()
    {
        $this->view->render();
    }

    public function searchAction(){
        $this->view->setDefaultContentType('application/json');
        $fields = $this->_request->getPost();
        $artist = $fields['artist'];

        $results = SpotifyApi\Spotify::searchArtist($artist);
        echo json_encode($results);
    }
}

?>