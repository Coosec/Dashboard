<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Core;

/**
 * Class Request
 * @package Jacob\Core
 */
class Request
{
    /**
     * @var
     */
    protected $action;
    /**
     * @var
     */
    protected $controller;

    /**
     * @var
     */
    protected $_postFields;
    /**
     * @var
     */
    protected $_getFields;
    /**
     * @var
     */
    protected $_requestUri;

    /**
     * Request constructor.
     * @param $request
     */
    public function __construct($request)
    {

                $this->_getFields = $_GET;

                $this->_postFields = $_POST;

        $this->_requestUri = $_SERVER['REQUEST_URI'];

        $this->_request = $request;

    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->_postFields;
    }


    /**
     * @return array
     */
    public function getFields()
    {
        return $this->_getFields;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->_requestUri;
    }


    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setController($controller)
    {
        $this->controller = ucfirst($controller);

    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }
}