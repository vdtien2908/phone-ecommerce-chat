<?php
class App
{
    protected $controller = 'HomeController';
    protected $action = 'index';
    protected $params = [];

    function __construct()
    {
        $elementUrlBox = $this->handleUrl();

        // handle controller
        if (isset($elementUrlBox)) {
            $this->controller = ucfirst(strtolower($elementUrlBox[0])) . "Controller";
            //handle str
            if (file_exists('./app/controllers/' . $elementUrlBox[0] . 'Controller.php')) {
                unset($elementUrlBox[0]);
            }
        }

        require_once('./app/controllers/' . $this->controller . '.php');

        // handle action
        if (isset($elementUrlBox[1])) {
            if (method_exists($this->controller, $elementUrlBox[1])) {
                $this->action = $elementUrlBox[1];
            }
            unset($elementUrlBox[1]); //remove elementUrlBox
        }

        // handle param
        $this->params = $elementUrlBox ? array_values($elementUrlBox) : [];

        // Init Controller
        $this->controller = new $this->controller;
        ($this->controller)->{$this->action}(...$this->params);
    }

    // handle Url
    function handleUrl()
    {
        if (isset($_REQUEST['url'])) {
            return explode('/', filter_var(trim($_REQUEST['url'], '/')));
        }
    }
}
