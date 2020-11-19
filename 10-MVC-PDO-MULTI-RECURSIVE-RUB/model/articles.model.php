<?php
// All articles
function selectAllArticles(PDO $c){
    // sélection de tous les articles sur l'accueil
    $sql = "SELECT a.* FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        ORDER BY a.articles_date DESC";
    $request = $c->query($sql);
    return ($request->rowCount()) ? $request->fetchAll(PDO::FETCH_ASSOC) : [];
}