<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Core;


use Jacob\Core\Exceptions\ControllerNotFound;

class Router
{

    const CONTROLLERS_PATH = 'Controllers';

    /**
     * @var Request
     */
    protected $_request;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->_request = $request;
        $this->matchRequest();
        $this->getController();

    }

    /**
     * @return mixed
     */
    private function getController() {
        try {
            $requestedController = '\Jacob\Controllers\\'.$this->_request->getController().'Controller';

            if(class_exists($requestedController)) {
            return new $requestedController($this->_request);
            }
            else {
                throw new ControllerNotFound('Kontroler: '.$this->_request->getController().' nie istnieje!');
            }
        } catch(ControllerNotFound $e)
        {
            \Jacob\Utils\Debug::showError($e->getMessage());
        }
    }

    private function matchRequest() {
        $controllerAction = preg_match('/\w+\/?\w+/',$this->_request->getRequestUri(),$matches);
        if($controllerAction){
            $matchedPaths = explode('/',$matches[0]);
            $controller = $matchedPaths[0];
            $action = isset($matchedPaths[1]) ? $matchedPaths[1] : 'index';
            $this->_request->setAction($action);
            $this->_request->setController($controller);
        }

    }



}