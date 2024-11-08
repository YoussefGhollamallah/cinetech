<?php

// Path: app/controllers/HomeController.php

class HomeController
{
    public function home()
    {
        $title = "Cinetech";
        $view = new View("index");
        $view->setVars(["title" => $title]);
        $view->render();
    }

    public function erreur404()
    {
        $title = "Erreur 404";
        $view = new View("404Erreur");
        $view->setVars(["title" => $title]);
        $view->render();
    }

    public function register()
    {
        $title = "Inscription";
        $view = new View("register");
        $view->setVars(["title" => $title]);
        $view->render();
    }

    public function login()
    {
        $title = "Connexion";
        $view = new View("login");
        $view->setVars(["title" => $title]);
        $view->render();
    }

    
}