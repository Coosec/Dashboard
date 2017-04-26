<?php

namespace Jacob\Controllers;
use Jacob\Core\Controller;

class WeatherController extends Controller
{
	private $key = "5bdef6e56782bed3408edf8753cb5263";
	private $openWeatherApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=";

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

            $url = $this->openWeatherApiUrl . "{$address}" . "&appid=" . "{$this->key}";
        
            $resp_json = file_get_contents($url);
            
            $resp = json_decode($resp_json, true);
            var_dump($resp); die;
            if($resp['status'] === 'OK'){
                $response = $this->getCurrentWeatherConditionsFromAPI($resp);
            }
        }
        echo json_encode($response);
    }

	private function getCurrentWeatherConditionsFromAPI($openWeatherResponse)
	{
		$temperature = $openWeatherResponse['weather']['main']['temp'];
		$result = array(
                'temperature' => $temperature
            );
		return $result;			
	}
}