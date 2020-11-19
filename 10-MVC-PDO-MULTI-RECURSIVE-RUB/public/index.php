<?php
// Front controller

// dependencies
require_once "../config.php";
require_once "../model/menuMultiBootstrap.model.php";
require_once "../model/rubriques.model.php";
require_once "../model/articles.model.php";

// connexion
try {
    $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_USER, DB_PWD);

}catch(PDOException $e){
    $erreur = $e->getCode();
    $erreur .= " : ";
    $erreur .= $e->getMessage();
    die($erreur);
}

// controllers
require_once "../controller/public.controller.php";

