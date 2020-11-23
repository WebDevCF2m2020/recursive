<?php
// select all rubriques for menu
$allMenu = selectAllRubriques($connexion);
// recursive menu
$menu = createMenuMultiBootstrap(0, 0, $allMenu);

// if rubriques selected
$idrub = (isset($_GET['rub']) && ctype_digit($_GET['rub']))
    ? (int)$_GET['rub']
    : 0;

// homepage
if(!$idrub) {
// All articles
    $allArticles = selectAllArticles($connexion);

// view
    require_once "../view/home.view.php";
}else{

    $rubriques = selectRubriquesById($connexion,$idrub);
    if(empty($rubriques)) {
        header("Location: ./");
        exit();
    }
    // create Arial
    $arial = createRubriquesAriane($connexion,$idrub);
    // articles
    $allArticles = selectAllArticlesCateg($connexion,$idrub);
// view
    require_once "../view/rubriques.view.php";

}