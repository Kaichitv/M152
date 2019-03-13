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
    $tblFiles = $_FILES["image"];
    $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
    $idPost = insertPostMedia($tblFiles, $commentaire);
    header("Location: index.php?message=Upload réussi");
}

if (isset($_POST["sendVid"])) {
    $tblFiles = $_FILES["video"];
    $commentaire = filter_input(INPUT_POST, "commentaireVid", FILTER_SANITIZE_STRING);
    $idPost = insertPostMedia($tblFiles, $commentaire);
    header("Location: index.php?message=Upload réussi");
}

if (isset($_POST["sendAud"])) {
    $tblFiles = $_FILES["audio"];
    $commentaire = filter_input(INPUT_POST, "commentaireAud", FILTER_SANITIZE_STRING);
    $idPost = insertPostMedia($tblFiles, $commentaire);
    header("Location: index.php?message=Upload réussi");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Post</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">M152</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="post.php">Post</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br>
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

