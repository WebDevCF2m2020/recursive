<?php
// dependencies
require_once "config.php";

// on essaie de se connecter
try {
    // instanciation de PDO
    $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_USER, DB_PWD);

// en cas d'erreur de connexion, on va utiliser la classe PDOException qui représente une erreur émise par PDO.
}catch(PDOException $e){
    // on capture notre erreur
    $erreur = $e->getCode();
    $erreur .= " : ";
    $erreur .= $e->getMessage();
    // arrêt du script
    die($erreur);
}