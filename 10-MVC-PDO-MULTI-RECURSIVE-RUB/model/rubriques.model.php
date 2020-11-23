<?php
// All rubriques
function selectAllRubriques(PDO $c)
{
    $sql = "SELECT * FROM rubriques ORDER BY rubriques_order ASC";
    $request = $c->query($sql);
    return ($request->rowCount()) ? $request->fetchAll(PDO::FETCH_ASSOC) : [];
}

// Rubriques by ID with all rows
function selectAllFromRubriquesById(PDO $c, int $id)
{
    $sql = "SELECT r.* 
            FROM rubriques r
            WHERE r.idrubriques = :idrubriques";
    $recup = $c->prepare($sql);
    $recup->bindValue(":idrubriques", $id, PDO::PARAM_INT);
    $recup->execute();
    return ($recup->rowCount()) ? $recup->fetch(PDO::FETCH_ASSOC) : [];
}

// Rubriques by ID without text
function selectRubriquesById(PDO $c, int $id)
{
    $sql = "SELECT r.idrubriques, r.rubriques_name, r.rubriques_idrubriques 
            FROM rubriques r
            WHERE r.idrubriques = :idrubriques";
    $recup = $c->prepare($sql);
    $recup->bindValue(":idrubriques", $id, PDO::PARAM_INT);
    $recup->execute();
    return ($recup->rowCount()) ? $recup->fetch(PDO::FETCH_ASSOC) : [];
}

// fonction récursive fil d'ariane
function createRubriquesAriane(PDO $c, int $idcateg, int $tab = 0, array &$table = [])
{
    $table[$tab] = selectRubriquesById($c, $idcateg);

    if (isset($table[$tab]['rubriques_idrubriques']) && $table[$tab]['rubriques_idrubriques'] != 0) {
        $id = (int)$table[$tab]['rubriques_idrubriques'];
        createRubriquesAriane($c, $id, $tab + 1, $table);
    }
    return array_reverse($table);

}