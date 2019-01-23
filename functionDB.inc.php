<?php

define('SERVER', "localhost");
define('DBNAME', "m152");
define('USER', "root");
define('PASS', "");

function getConnexion() {
    static $db = NULL;
    if ($db === NULL) {
        try {
            $connectionString = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . '';
            $db = new PDO($connectionString, USER, PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    } else {
        return $db;
    }
}

function insertPost($commentaire, $datePost) {
    try {
        $connexion = getConnexion();
        $requete = $connexion->prepare("INSERT INTO post (`commentaire`, `datePost`) VALUES (:commentaire, :datePost)");
        $requete->bindParam(":commentaire", $commentaire, PDO::PARAM_STR);
        $requete->bindParam(":datePost", $datePost, PDO::PARAM_STR);
        $requete->execute();
        return $connexion->lastInsertId();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function insertMedia($typeMedia, $nomMedia, $idPost){
    try {
        $connexion = getConnexion();
        $requete = $connexion->prepare("INSERT INTO post (`typeMedia`, `nomFichierMedia`, `idPost`) VALUES (:typeMedia, :nomMedia, :idPost)");
        $requete->bindParam(":typeMedia", $typeMedia, PDO::PARAM_STR);
        $requete->bindParam(":nomMedia", $nomMedia, PDO::PARAM_STR);
        $requete->bindParam(":idPost", $idPost, PDO::PARAM_STR);
        $requete->execute();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function getAllPost() {
    try {
        $connexion = getConnexion();
        $requete = $connexion->prepare("SELECT * FROM post");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    } catch (Exception $ex) {
        
    }
}
