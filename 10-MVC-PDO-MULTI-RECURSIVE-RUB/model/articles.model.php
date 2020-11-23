<?php
// All articles
function selectAllArticles(PDO $c)
{
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

// sélection de tous les articles dans une rubrique
    $sql = "SELECT a.*, (SELECT GROUP_CONCAT(ru.idrubriques,'---',  ru.rubriques_name SEPARATOR '|||')  FROM rubriques ru
		INNER JOIN articles_has_rubriques hru
			ON hru.rubriques_idrubriques = ru.idrubriques 
        INNER JOIN articles ar
			ON hru.articles_idarticles = ar.idarticles 
        WHERE ar.idarticles  = a.idarticles    
	) AS categ 
        FROM articles a 
        INNER JOIN articles_has_rubriques h
        ON h.articles_idarticles = a.idarticles
        INNER JOIN rubriques r
        ON h.rubriques_idrubriques = r.idrubriques
        WHERE r.idrubriques = :idrubriques 
        ORDER BY a.articles_date DESC";
    $recup = $c->prepare($sql);
    $recup->bindValue(":idrubriques", $idrub, PDO::PARAM_INT);
    $recup->execute();
    return ($recup->rowCount()) ? $recup->fetchAll(PDO::FETCH_ASSOC) : [];
}