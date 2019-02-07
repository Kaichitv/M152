<?php
require_once 'functionDB.inc.php';

if (isset($_POST["send"])) {
    if (isset($_POST["commentaire"])) {
        $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
        $idPost = insertPost($commentaire, $datePost);
    }
    if (isset($_FILES["image"])) {
        $arrayFiles = $_FILES["image"];
        for ($i = 0; $i < count($arrayFiles["name"]); $i++) {
            $dossier = 'upload/';
            $nomMedia = $arrayFiles["name"][$i];
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
            <form action="#" method="POST" id="fromImg" enctype="multipart/form-data"> 
                Selectionnner un fichier: <input type="file"  name="image[]" accept="image/*" multiple><br>
                <textarea name="commentaire" form="fromImg" rows="4" cols="50"></textarea><br>
                <!-- Limite la taille du fichier -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <input type="submit" name="send">
            </form>
        </div>
    </body>
</html>

