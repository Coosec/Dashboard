<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Controllers;
use Jacob\Core\Controller;

class TwitterController extends Controller
{



    public function indexAction()
    {
        $this->template = 'twitter.phtml';

    }

    public function usersAction()
    {
        print_R('bbbb');
        exit;
    }

}