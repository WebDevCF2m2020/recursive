<?php
// All rubriques
function selectAllRubriques(PDO $c){
    $sql = "SELECT * FROM rubriques ORDER BY rubriques_order ASC";
    $request = $c->query($sql);
    return ($request->rowCount()) ? $request->fetchAll(PDO::FETCH_ASSOC) : [];
}

// Rubriques by ID
function selectRubriquesById(PDO $c,int $id){
    $sql = "SELECT r.* 
            FROM rubriques r
            WHERE r.idrubriques = :idrubriques";
    $recup = $c->prepare($sql);
    $recup->bindValue(":idrubriques",$id,PDO::PARAM_INT);
    $recup->execute();
    return ($recup->rowCount()) ? $recup->fetch(PDO::FETCH_ASSOC) : [];
}

// fonction fil d'ariane
function createRubriquesAriane(PDO $c, int $parent,int $tab=0){
    $actual[$tab] = selectRubriquesById( $c,$parent);
    //var_dump($actual[$tab]);
    if(isset($actual[$tab]['rubriques_idrubriques'])){
        $id = (int)$actual[$tab]['rubriques_idrubriques'];
        $tab++;
        $actual[$tab] = createRubriquesAriane( $c,$id,$tab);

    }else{
        return $actual;
    }

}