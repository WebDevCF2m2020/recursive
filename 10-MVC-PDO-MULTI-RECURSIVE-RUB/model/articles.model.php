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