<?php
require "connection.php";
function ajouter_membres($mail, $nom, $ville = null, $sexe = null, $pass, $dtn)
{
    $sql = "INSERT INTO membre (email,nom,ville, genre, mdp, date_naissance) VALUES ('$mail', '$nom', '$ville', '$sexe', '$pass', '$dtn')";
    $requete = mysqli_query(dbconnect(), $sql);
    return $requete;
}

function get_categories() {
    $sql = "SELECT id_categorie as id, nom_categorie as nom FROM categorie_objet ORDER BY nom_categorie";
    $result = mysqli_query(dbconnect(), $sql);
    return $result;
}

function get_objets_vue($categorie_id = null) {
    if ($categorie_id) {
        $sql = "SELECT * FROM vue_objets_emprunts WHERE id_categorie = '$categorie_id' ORDER BY nom_objet";
    } else {
        $sql = "SELECT * FROM vue_objets_emprunts ORDER BY nom_objet";
    }
    $result = mysqli_query(dbconnect(), $sql);
    return $result;
}


?>