<?php

require_once 'config/autoload.php';

Autoload::start();

$request = $_GET["r"] ?? "index";

$routeur = new Routeur($request);
$routeur->renderController();

?>

