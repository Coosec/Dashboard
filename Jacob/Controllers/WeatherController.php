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

            $response = $this->getCurrentWeatherConditionsFromAPI($resp);
        }
        echo json_encode($response);
    }

	private function getCurrentWeatherConditionsFromAPI($openWeatherResponse)
	{
        //todo dobrze by bylo sprawdzic czy kazdy parametr jest ustawiony jak nie to zwracac pusty
        //metoda isset (jak nie wiesz jak mozna narazie zostawic)
        $weather = $openWeatherResponse['weather'][0];
		$main = $openWeatherResponse['main'];
        $wind = $openWeatherResponse['wind'];
        $name = $openWeatherResponse['name'];
        $result = array(
                'weather' => $weather,
                'main' => $main,
                'wind' => $wind,
                'place' => $name
            );
		return $result;			
	}
}