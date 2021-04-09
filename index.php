<?php

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

spl_autoload_register('autoload');

use controllers\AppController;

//include_once 'AppController.php';

class Application
{

    public function run() {
        session_start();
        $this->route();
    }

    private function route() {
        $url        = ltrim($_SERVER['REQUEST_URI'], '\/');
        $parsed_url = explode('/', $url);
        $method     = array_shift($parsed_url);
        if (empty($method)) { print_r((new AppController)->actionIndex()); }
        else {
            $method = 'action' . ucfirst($method);
            $controller = new AppController();
            if (method_exists($controller, $method)) {
                print_r($controller->$method());
            } else {
                header("Location: /");
            }
        }
    }
}

(new Application)->run();
