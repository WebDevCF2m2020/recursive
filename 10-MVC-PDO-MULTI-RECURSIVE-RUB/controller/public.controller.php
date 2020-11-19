<?php
// select all rubriques for menu
$allMenu = selectAllRubriques($connexion);
// recursive menu
$menu = createMenuMultiBootstrap(0, 0, $allMenu);


// All articles
$allArticles = selectAllArticles($connexion);

// view
require_once "../view/home.view.php";