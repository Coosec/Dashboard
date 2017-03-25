<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Core;


class View
{
    public $layout;

    protected $viewsDir = '/home/kuba/Projekty/dashboard/Views';

    public function __construct(Request $request)
    {

        $this->pathToLayout = $this->viewsDir.'/layout/standard.phtml';
        $this->pathToView = $request->getController().'/'.$request->getAction().'.phtml';
    }

    public function render()
    {
        if($this->getLayout()){
            ob_start( );
            $content = ob_get_clean( );
            return $content;
        }

    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}