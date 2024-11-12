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
        "profile" => ["controller" => "HomeController", "method" => "profile"],
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
                $controllerInstance = new $controller();
    
                // Récupérer les paramètres depuis l'URL pour 'detail'
                if ($request === 'detail') {
                    // Exemple d'URL : /detail/94605/serie
                    $urlParts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
                    if (count($urlParts) === 3) {
                        $id = $urlParts[1];  // Premier paramètre (id)
                        $type = $urlParts[2]; // Deuxième paramètre (type)
                        
                        // Valider l'ID et le type
                        if (is_numeric($id) && ($type === 'film' || $type === 'serie')) {
                            if (method_exists($controllerInstance, $method)) {
                                $controllerInstance->$method($id, $type); // Appel de la méthode avec l'ID et le type
                            } else {
                                $this->redirect404();
                            }
                        } else {
                            $this->redirect404();  // ID ou type invalide
                        }
                    } else {
                        $this->redirect404();  // Structure d'URL incorrecte
                    }
                } else {
                    // Récupérer sans paramètres supplémentaires
                    if (method_exists($controllerInstance, $method)) {
                        $controllerInstance->$method();
                    } else {
                        $this->redirect404();
                    }
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
