<?php
namespace DIAMOND\Core\Library;

class FrontController
{
    use Helper;
    const NOT_FOUND_ACTION      = 'notFoundAction';
    const NOT_FOUND_CONTROLLER  = 'DIAMOND\controller\NotFoundController';
    private $_controller        = 'index';
    private $_action            = 'default';
    private $_params            = [];
    private $_template;
    private $_registry;

    public function __construct(Template $template, Registry $registry){
        $this->_template        = $template;
        $this->_registry        = $registry;
        $this->_parseUrl();
    }
    private function _parseUrl()
    {
        $url = explode(DS, trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), DS), 3);

        if (isset($url[0]) && $url[0] != ''){
            $this->_controller  = $url[0];
        }
        if (isset($url[1]) && $url[1] != '' ){
            $this->_action      = $url[1];
        }
        if (isset($url[2]) && $url[2] != '' ){
            $this->_params      = explode(DS, $url[2]);
        }
    }
    public function dispatch()
    {
        $controllerClassName    = 'DIAMOND\controller\\' . ucfirst($this->_controller) . 'Controller';
        $actionName             = $this->_action . 'Action';
        if(!class_exists($controllerClassName) || !method_exists($controllerClassName, $actionName)) {
            $controllerClassName            = self::NOT_FOUND_CONTROLLER;
            $this->_action = $actionName    = self::NOT_FOUND_ACTION;
        }

        $controller = new $controllerClassName();
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setRegistry($this->_registry);
        $controller->$actionName();
    }
}