<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Controllers;
use Jacob\Core\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {

      $this->view->render();

    }

}