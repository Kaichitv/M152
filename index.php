<?php

/*
  Projet: M152
  Description: Page principale affichant le fil d'actualité 
  Auteur: Jacot-dit-Montandon Ludovic
  Version: 1.0
  Date: 2018-19
 */

require_once 'functionDB.inc.php';

$arrPost = getAllPost();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="index.php">Home</a>
            <a href="post.php">Post</a>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
            <img src="img/photoprofil.jpg" alt=""/>
            <p>Bienvenu</p>
                </div>
                </div>
            <div class="row"
            <?php
            foreach ($arrPost as $post) {
                
                echo '<div class="col-md-12 btn-info">';
                
                $idPost = $post["idPost"];
                
                $media = getMediaById($idPost);
                
                for ($i = 0; $i < count($media); $i++) {
                    if ($media[$i]["typeMedia"] == "image/jpeg" || $media[$i]["typeMedia"] == "image/png" || $media[$i]["typeMedia"] == "image/jpg" || $media[$i]["typeMedia"] == "image/gif") {
                        echo '<figure><img class="col-md-4" src="upload/' . $media[$i]["nomFichierMedia"] . '" alt="" /><figcaption>' . $post["commentaire"] . '</figcaption></figure>';
                    } else if ($media[$i]["typeMedia"] == "video/mp4" || $media[$i]["typeMedia"] == "video/wmv" || $media[$i]["typeMedia"] == "image/mov" || $media[$i]["typeMedia"] == "video/avi") {
                        echo '<figure><video class="col-md-4" width="1080" height="720" autoplay controls><source src="upload/' . $media[$i]["nomFichierMedia"] . '" type="' . $media[$i]["typeMedia"] . '"></video><figcaption>' . $post["commentaire"] . '</figcaption></figure>';
                    } else {
                        echo '<figure><audio class="col-md-4" controls><source src="upload/' . $media[$i]["nomFichierMedia"] . '" type="' . $media[$i]["typeMedia"] . '"></audio><figcaption>' . $post["commentaire"] . '</figcaption></figure>';
                    }
                }
                
                echo '</div>';
            }
            ?>
        </div>
        </div>
    </body>
</html>
