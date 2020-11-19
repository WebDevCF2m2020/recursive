<?php
// All rubriques
function selectAllRubriques(PDO $c){
    $sql = "SELECT * FROM rubriques ORDER BY rubriques_order ASC";
    $request = $c->query($sql);
    return ($request->rowCount()) ? $request->fetchAll(PDO::FETCH_ASSOC) : [];
}