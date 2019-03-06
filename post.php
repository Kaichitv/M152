<?php

/*
  Projet: M152
  Description: Formulaire pour insérer des images, vidéos ou audios
  Auteur: Jacot-dit-Montandon Ludovic
  Version: 1.0
  Date: 2018-19
 */

require_once 'functionDB.inc.php';

if (isset($_POST["sendImg"])) {
    if (isset($_POST["commentaire"])) {
        $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
        $idPost = insertPost($commentaire, $datePost);
    }
    if (isset($_FILES["image"])) {
        $arrayFiles = $_FILES["image"];
        for ($i = 0; $i < count($arrayFiles["name"]); $i++) {
            $dossier = 'upload/';
            //$nomMedia = $arrayFiles["name"][$i];
            $nomMedia = uniqid();
            $typeMedia = $arrayFiles["type"][$i];
            $datePost = date("Y-m-d H:i:s");
            if (move_uploaded_file($arrayFiles["tmp_name"][$i], $dossier . $nomMedia)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné
                insertMedia($typeMedia, $nomMedia, $idPost);
                header("Location: index.php");
            }
            //Sinon (la fonction renvoie FALSE).
            else {
                echo "Echec de l\'upload !";
            }
        }
    }
}

if (isset($_POST["sendVid"])) {
    if (isset($_POST["commentaireVid"])) {
        $commentaire = filter_input(INPUT_POST, "commentaireVid", FILTER_SANITIZE_STRING);
        $idPost = insertPost($commentaire, $datePost);
    }
    if (isset($_FILES["video"])) {
        $arrayFiles = $_FILES["video"];
        for ($i = 0; $i < count($arrayFiles["name"]); $i++) {
            $dossier = 'upload/';
            //$nomMedia = $arrayFiles["name"][$i];
            $nomMedia = uniqid();
            $typeMedia = $arrayFiles["type"][$i];
            $datePost = date("Y-m-d H:i:s");
            if (move_uploaded_file($arrayFiles["tmp_name"][$i], $dossier . $nomMedia)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné
                insertMedia($typeMedia, $nomMedia, $idPost);
                header("Location: index.php");
            }
            //Sinon (la fonction renvoie FALSE).
            else {
                echo "Echec de l\'upload !";
            }
        }
    }
}

if (isset($_POST["sendAud"])) {
    if (isset($_POST["commentaireAud"])) {
        $commentaire = filter_input(INPUT_POST, "commentaireAud", FILTER_SANITIZE_STRING);
        $idPost = insertPost($commentaire, $datePost);
    }
    if (isset($_FILES["audio"])) {
        $arrayFiles = $_FILES["audio"];
        for ($i = 0; $i < count($arrayFiles["name"]); $i++) {
            $dossier = 'upload/';
            //$nomMedia = $arrayFiles["name"][$i];
            $nomMedia = uniqid();
            $typeMedia = $arrayFiles["type"][$i];
            $datePost = date("Y-m-d H:i:s");
            if (move_uploaded_file($arrayFiles["tmp_name"][$i], $dossier . $nomMedia)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné
                insertMedia($typeMedia, $nomMedia, $idPost);
                header("Location: index.php");
            }
            //Sinon (la fonction renvoie FALSE).
            else {
                echo "Echec de l\'upload !";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Post</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="post.php">Post</a>
        </nav>
        <div>
            <h1>Image</h1>
            <form action="#" method="POST" id="formImg" enctype="multipart/form-data"> 
                Selectionnner un fichier: <input type="file"  name="image[]" accept="image/*" multiple><br>
                <textarea name="commentaire" form="formImg" rows="4" cols="50"></textarea><br>
                <!-- Limite la taille du fichier -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <input type="submit" name="sendImg">
            </form>
            <h1>Video</h1>
            <form action="#" method="POST" id="formVid" enctype="multipart/form-data"> 
                Selectionnner un fichier: <input type="file"  name="video[]" accept="video/*" multiple><br>
                <textarea name="commentaireVid" form="formVid" rows="4" cols="50"></textarea><br>
                <!-- Limite la taille du fichier -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <input type="submit" name="sendVid">
            </form>
            <h1>Audio</h1>
            <form action="#" method="POST" id="formAud" enctype="multipart/form-data"> 
                Selectionnner un fichier: <input type="file"  name="audio[]" accept="audio/*" multiple><br>
                <textarea name="commentaireAud" form="formAud" rows="4" cols="50"></textarea><br>
                <!-- Limite la taille du fichier -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <input type="submit" name="sendAud">
            </form>
        </div>
    </body>
</html>

