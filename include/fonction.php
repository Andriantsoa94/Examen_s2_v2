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
function get_objet_by_id($id_objet) {
    $id_objet = intval($id_objet);
    $sql = "SELECT id_objet, nom_objet, nom_categorie, proprietaire_nom, statut_emprunt FROM vue_objets_emprunts WHERE id_objet = '$id_objet'";
    $result = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($result);
}

<<<<<<< HEAD
function get_images_objet($id_objet) {
    $id_objet = intval($id_objet);
    $sql = "SELECT nom_image as url FROM image_objet WHERE id_objet = '$id_objet' ORDER BY id_image";
    $result = mysqli_query(dbconnect(), $sql);
    $images = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row;
    }
    return $images;
}

function get_historique_emprunts($id_objet) {
    $id_objet = intval($id_objet);
    $sql = "SELECT emprunteur_nom, date_emprunt, date_retour FROM vue_objets_emprunts WHERE id_objet = '$id_objet' ORDER BY date_emprunt DESC";
    $result = mysqli_query(dbconnect(), $sql);
    $historique = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $historique[] = $row;
    }
    return $historique;
=======
function upload_img($id, $name) {
    $sql = "INSERT INTO image_objet (id_objet, nom_image) VALUES ('$id', '$name')";
    $requete = mysqli_query(dbconnect(), $sql);
    return $requete;
>>>>>>> c97fa1dc0dd17bd60cb415f9db6724d1048428a3
}

?>