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
        if (!empty($elementUrlBox[0])) {
            $this->controller = ucfirst(strtolower($elementUrlBox[0])) . "Controller";
           
            if (file_exists('./app/controllers/' . $this->controller . '.php')) {
                unset($elementUrlBox[0]);
            } else {
                $this->controller = 'HomeController';
            }
        }

        require_once('./app/controllers/' . $this->controller . '.php');

        // handle action
        if (!empty($elementUrlBox[1])) {
            if (method_exists($this->controller, $elementUrlBox[1])) {
                $this->action = $elementUrlBox[1];
                unset($elementUrlBox[1]);
            }
        }

        // handle param
        $this->params = $elementUrlBox ? array_values($elementUrlBox) : [];
        
        // Init Controller
        $this->controller = new $this->controller;
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    // handle Url
    function handleUrl()
    {
        if (isset($_REQUEST['url'])) {
            return explode('/', filter_var(trim($_REQUEST['url'], '/')));
        }
    }
}
