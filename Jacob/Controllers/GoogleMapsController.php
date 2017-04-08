<?php

namespace Jacob\Controllers;
use Jacob\Core\Controller;

class GoogleMapsController extends Controller
{

    private $googleApiUrl = "http://maps.google.com/maps/api/geocode/json?address=";
    private $zoom = "12";
    private $size = "600x400";
    private $key = "AIzaSyAiZXQpQujPkUj-ARca4F1gBaSE0IgqjqQ";

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
        //consider read and return more params from this api
        $latitude = $googleResponse['results'][0]['geometry']['location']['lat'];
        $longtitude = $googleResponse['results'][0]['geometry']['location']['lng'];
        $formatted_address = $googleResponse['results'][0]['formatted_address'];
        $result = array();          
        if($latitude && $longtitude && $formatted_address)
        {
            $cord = $latitude.",".$longtitude;
            $result = array(
                // 'latitude' => $latitude,
                // 'longtitude' => $longtitude,
                'formattedAddress' => $formatted_address,
                'src' => "https://maps.googleapis.com/maps/api/staticmap?center=".$cord."&zoom=".$this->zoom."&size=".$this->size."&markers=color:red%7Clabel:C%7C".$cord."&key=".$this->key.""
            );
        }

        return $result;
    }
}