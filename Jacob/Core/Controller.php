<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */
namespace Jacob\Core;
use Jacob\Core\Exceptions\ActionNotFound;
use Jacob\Utils\Debug;

/**
 * Class Controller
 * @package Jacob\Core
 */
abstract class Controller
{

    const SUFFIX_CONTROLLER_ACTION = 'Action';

    /**
     * @var Request
     */
    protected $_request;

    protected $_template;
    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->_request = $request;
        $this->view = new View;
        $action = $request->getAction().self::SUFFIX_CONTROLLER_ACTION;

     try {
         if (is_callable(array($this, $action))) {
             $this->$action();
         } else {
             throw new ActionNotFound('Żądana akcja ' .$request->getAction() . ' jest niedostępna!');
         }
     } catch(ActionNotFound $e) {
         Debug::showError($e->getMessage());
     }
    }

    public function getRequest()
    {

    }

}