<?php
// All articles
function selectAllArticles(PDO $c){
    // sélection de tous les articles sur l'accueil
    $sql = "SELECT a.*, 
       GROUP_CONCAT(r.idrubriques) AS idrubriques, 
       GROUP_CONCAT(r.rubriques_name SEPARATOR '|||') AS rubriques_name
        FROM articles a 
            LEFT JOIN articles_has_rubriques h
                ON h.articles_idarticles = a.idarticles
            LEFT JOIN rubriques r
                ON h.rubriques_idrubriques = r.idrubriques
        GROUP BY a.idarticles
        ORDER BY a.articles_date DESC";
    $request = $c->query($sql);
    return ($request->rowCount()) ? $request->fetchAll(PDO::FETCH_ASSOC) : [];
}

// All articles into a category and/or subcategories
function selectAllArticlesCateg(PDO $c, int $idrub)
{

// sélection de tous les articles dans une rubrique ou dans le premier niveau de sous-rubrique
    $sql = "SELECT a.* 
        FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        WHERE r.idrubriques = :idrubriques 
        ORDER BY a.articles_date DESC";
    $recup = $c->prepare($sql);
    $recup->bindValue(":idrubriques",$idrub,PDO::PARAM_INT);
    $recup->execute();
    return ($recup->rowCount()) ? $recup->fetch(PDO::FETCH_ASSOC) : [];
}