<?php
class HomeController
{
    public function home()
    {
        $title = "Cinetech";
        $this->renderView("index", ["title" => $title]);
    }

    public function erreur404()
    {
        $title = "Erreur 404";
        $this->renderView("404Erreur", ["title" => $title]);
    }

    public function register()
    {
        $title = "Inscription";
        $this->renderView("register", ["title" => $title]);
    }

    public function login()
    {
        $title = "Connexion";
        $this->renderView("login", ["title" => $title]);
    }

    public function film()
    {
        $title = "Films";
        $this->renderView("film", ["title" => $title]);
    }

    public function serie()
    {
        $title = "Série";
        $this->renderView("serie", ["title" => $title]);
    }

    public function profile()
    {
        $title = "Profil";
        $this->renderView("profile", ["title" => $title]);
    }



    public function renderView($viewName, $vars = [])
    {
        $view = new View($viewName);
        $view->setVars($vars);
        $view->render();
    }
}
