<?php

namespace Jacob\Controllers;
use Jacob\Core\Controller;

class GoogleMapsController extends Controller
{

    private $googleApiUrl = "http://maps.google.com/maps/api/geocode/json?address=";

    public function indexAction()
    {
           $this->view->render();
    }

    public function addressAction()
    {
        $this->view->setDefaultContentType('application/json');
        $fields = $this->_request->getPost();
        $address = $fields['address'];

        if(!isset($address)) 
        {
            $response = 'Podaj cokolwiek!';

        } else {
            $address = urlencode($address);

            $url = $this->googleApiUrl . "{$address}";
        
            $resp_json = file_get_contents($url);
            
            $resp = json_decode($resp_json, true);

            if($resp['status'] === 'OK'){
                $response = $this->getApiResult($resp);
            }
        }
        echo json_encode($response);
    }

    private function getApiResult($googleResponse)
    {
        //consider read and return from more params
        $latitude = $googleResponse['results'][0]['geometry']['location']['lat'];
        $longtitude = $googleResponse['results'][0]['geometry']['location']['lng'];
        $formatted_address = $googleResponse['results'][0]['formatted_address'];
        $result = array();          
        if($latitude && $longtitude && $formatted_address)
        {
            $result = array(
                'latitude' => $latitude,
                'longtitude' => $longtitude,
                'formatted_address' => $formatted_address
            );
        }

        return $result;
    }
}