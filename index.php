<?php

require_once 'config/autoload.php';

Autoload::start();

if (isset($_GET['r'])) {
    $request = $_GET['r'];
} else {
    $request = 'index'; // Par défaut, redirige vers la page d'accueil
}

$routeur = new Routeur($request);
$routeur->renderController();
