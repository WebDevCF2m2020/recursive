<?php





// récupération de l'idrubriques si elle existe
$idrub = (isset($_GET['rub']) && ctype_digit($_GET['rub']))
    ? (int)$_GET['rub']
    : 0;

// dans un rubrique
if($idrub){
    // sélection de tous les articles dans une rubrique ou dans le premier niveau de sous-rubrique
    $sql = "SELECT a.* FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        WHERE r.idrubriques = $idrub OR r.idrubriques IN (SELECT ri.idrubriques FROM rubriques ri WHERE $idrub=ri.rubriques_idrubriques)
        ORDER BY a.articles_date DESC";

// accueil
}else{
    // sélection de tous les articles sur l'accueil
    $sql = "SELECT a.* FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        ORDER BY a.articles_date DESC";
}



// récupération des articles
$request = $connexion->query($sql);

// nombre d'articles
$nbArticles = $request->rowCount();

// si on a au moins un article
$articles = ($nbArticles)
    ? $request->fetchAll(PDO::FETCH_ASSOC)
    : [];




