<?php

class Routeur
{
    private $request;

    private $routes = [
        "index" => ["controller" => "HomeController", "method" => "home"],
        "404Erreur" => ["controller" => "HomeController", "method" => "erreur404"],
        "register" => ["controller" => "HomeController", "method" => "register"],
        "login" => ["controller" => "HomeController", "method" => "login"],
        "film" => ["controller" => "HomeController", "method" => "film"],
        "serie" => ["controller" => "HomeController", "method" => "serie"],
    ];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function renderController()
    {
        $request = $this->request;
        
        if (array_key_exists($request, $this->routes)) {
            $controller = $this->routes[$request]["controller"];
            $method = $this->routes[$request]["method"];
            
            if (class_exists($controller)) {
                $controller = new $controller();
                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                   $this->redirect404();
                }
            } else {
                $this->redirect404();
            }
        } else {
            $this->redirect404();
        }
  
    }

    public function redirect404()
    {
        $controller = $this->routes["404Erreur"]["controller"];
        $method = $this->routes["404Erreur"]["method"];

        $controller = new $controller();
        $controller->$method();
    }
}