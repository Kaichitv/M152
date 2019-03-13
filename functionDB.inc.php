<?php

/*
  Projet: M152
  Description: Fichier regroupant toutes les fonctions avec la base
  Auteur: Jacot-dit-Montandon Ludovic
  Version: 1.0
  Date: 2018-19
 */

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

function insertPostMedia($tblFiles, $commentaire)
{    
    $connexion = getConnexion();
    try {
        
        $connexion->beginTransaction();
        $datePost = date("Y-m-d H:i:s");
        $lastInsertId = insertPost($commentaire, $datePost);
        $arrayFiles = $tblFiles;
        for ($i = 0; $i < count($arrayFiles["name"]); $i++) {
            $dossier = 'upload/';
            //$nomMedia = $arrayFiles["name"][$i];
            $nomMedia = uniqid();
            $typeMedia = $arrayFiles["type"][$i];
            if (move_uploaded_file($arrayFiles["tmp_name"][$i], $dossier . $nomMedia)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné
                insertMedia($typeMedia, $nomMedia, $lastInsertId);
            }
            //Sinon (la fonction renvoie FALSE).
            else {
                echo "Echec de l\'upload !";
            }
        }
        $connexion->commit();
       } catch (Exception $ex) {
        $connexion->rollback();
    }
}

function insertPost($commentaire, $datePost) {
        $connexion = getConnexion();
        $requete = $connexion->prepare("INSERT INTO post (`commentaire`, `datePost`) VALUES (:commentaire, :datePost)");
        $requete->bindParam(":commentaire", $commentaire, PDO::PARAM_STR);
        $requete->bindParam(":datePost", $datePost, PDO::PARAM_STR);
        $requete->execute();
        return $connexion->lastInsertId();
}

function insertMedia($typeMedia, $nomMedia, $idPost){
        $connexion = getConnexion();
        $requete = $connexion->prepare("INSERT INTO media (`typeMedia`, `nomFichierMedia`, `idPost`) VALUES (:typeMedia, :nomMedia, :idPost)");
        $requete->bindParam(":typeMedia", $typeMedia, PDO::PARAM_STR);
        $requete->bindParam(":nomMedia", $nomMedia, PDO::PARAM_STR);
        $requete->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        echo $requete->execute();
}

function deletePost($idPost) {
    try {
        $connexion = getConnexion();
        $requete = $connexion->prepare("DELETE FROM `post` WHERE `idPost`=" .$idPost);
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
function getAllMedia(){
    try {
        $connexion = getConnexion();
        $requete = $connexion->prepare("SELECT * FROM media");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    } catch (Exception $ex) {
        
    }
}

function getMediaById($idPost){
    try {
        $connexion = getConnexion();
        $requete = $connexion->prepare("SELECT * FROM media WHERE idPost=" . $idPost);
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    } catch (Exception $ex) {
        
    }
}
