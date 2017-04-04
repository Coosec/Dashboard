<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Core;


class View
{
    public $layout = true;

    protected $viewsDir;

    protected $attributes = [];

    protected $defaultContentType = 'text/html';

    public function __construct(Request $request)
    {

        $this->pathToLayout = APP_PATH_VIEWS.'layout/standard.phtml';
        $this->pathToView = APP_PATH_VIEWS .strtolower($request->getController().'/'.$request->getAction().'.phtml');
    }

    public function render($data = [])
    {
       echo $this->fetch($data);
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

    /**
     * @param array $data
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function fetch(array $data = []) {

        if (!is_file($this->pathToView )) {
            throw new \RuntimeException("Nie można wyrenderować `$this->pathToView` bo szablon po prostu nie istnieje!!");
        }

        $data = array_merge($this->attributes, $data);
        try {

            ob_start();
            $this->protectedIncludeScope($this->pathToView , $data);
            $output = ob_get_clean();
        } catch(\Throwable $e) {
            ob_end_clean();
            throw $e;
        } catch(\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        return $output;
    }
    /**
     * @param string $template
     * @param array $data
     */
    protected function protectedIncludeScope ($template, array $data) {

        $data['template'] = $template;
        extract($data);

        header('Content-type: '.$this->defaultContentType);
        if($this->getLayout()){

            include $this->pathToLayout;
        } else {
            include $template;
        }
    }


    public function setDefaultContentType($contentType)
    {
        header('Content-type: '.$contentType);
    }
}