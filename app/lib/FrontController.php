<?php

namespace PHPMVC\lib;

class FrontController
{

    protected $_controller = "IndexController";
    protected $_action = "default";
    protected $_params = array();

    public function __construct()
    {
        $this->_parseUrl();
        $this->dispatch();
    }

    private function _parseUrl()
    {
        $url = explode("/", trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/"), 3);
        if (isset($url[0]) && $url[0] != "") {
            $this->_controller = $url[0];
        }
        if (isset($url[1]) && $url[1] != "") {
            $this->_action = $url[1];
        }
        if (isset($url[2]) && $url[2] != "") {
            $this->_params = explode("/", $url[2]);
        }
    }


    public function dispatch()
    {
        if (file_exists(APP_PATH.DS."controllers".DS.ucwords($this->_controller).".php")){
            require_once APP_PATH.DS."controllers".DS.ucwords($this->_controller).".php" ;
        }else {
            $this->_controller = "NotfoundController";
        }


        // is there UserSession ??
        if (isset($_SESSION['username'])) {
            $controllerclassname = "PHPMVC\controllers\\" . ucwords($this->_controller);
            $obj = new $controllerclassname;
            $actionname = $this->_action;
            if (!method_exists($obj, $this->_action)) {
                $this->_action = $actionname = "index";
                $this->_controller = "NotfoundController";
                $controllerclassname = "PHPMVC\controllers\\" . ucwords($this->_controller);
                $obj = new $controllerclassname;
                call_user_func_array(array($obj, $actionname), $this->_params);
                return;
            }

            // to allow admin go anywhere using URL
            if (isset($_SESSION['username']) && $_SESSION['roles'] == "1") {
                call_user_func_array(array($obj, $actionname), $this->_params);
                return;
            } // to avoid user from Admin Controller using URL
            elseif (isset($_SESSION['username']) && $_SESSION['roles'] == "0" && (strpos($this->_controller, 'Admin') !== false)) {
                $this->_controller = "NotfoundController";
                $this->Auth($this->_controller);
            }
            call_user_func_array(array($obj, $actionname), $this->_params);

            // to avoid user Returning To profile after logout
            //there is no session
        }
        else {
            if ($this->_controller != "SignInController" &&
                $this->_controller != "SignUpController" &&
                $this->_controller != "OutHomeController"
            ) {
                $this->_controller = "OutHomeController";
                $this->Auth($this->_controller);
            }else{
                $controllername = "PHPMVC\controllers\\" . ucwords($this->_controller);
                $obj = new $controllername;
                $actionname = $this->_action;
                call_user_func_array(array($obj, $actionname), $this->_params);
            }
        }
    }

    public function Auth($controllername)
    {
        $controllername = "PHPMVC\CONTROLLERS\\" . ucwords($this->_controller);
        $obj = new $controllername;
        $this->_action = "index";
        $actionname = $this->_action;
        $this->_params = array();
        call_user_func_array(array($obj, $actionname), $this->_params);
        return;
    }

}