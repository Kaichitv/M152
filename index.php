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
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
}

if(isset($_GET["idPost"]) && isset($_GET["delete"]))
{
    deletePost($_GET["idPost"]);
    header("Location: index.php");
}

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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">M152</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="post.php">Post</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h1 class="my-5">Home</h1>
                    <img class="card-img-top" src="img/photoprofil.jpg" alt=""/>
                    <p  class="card-footer">Bienvenu</p>
                    <?php if(isset($message)){ echo $message;  }?>
                </div>
                <div class="col-lg-9">

                    <div class="row">

                        <?php
                        foreach ($arrPost as $post) {

                            echo '<div class="col-lg-12 col-md-12 mb-4">'
                            . '<div class="card h-100">';

                            $idPost = $post["idPost"];

                            $media = getMediaById($idPost);

                            for ($i = 0; $i < count($media); $i++) {
                                if ($media[$i]["typeMedia"] == "image/jpeg" || $media[$i]["typeMedia"] == "image/png" || $media[$i]["typeMedia"] == "image/jpg" || $media[$i]["typeMedia"] == "image/gif") {
                                    echo '<figure><img class="card-img-top" src="upload/' . $media[$i]["nomFichierMedia"] . '" alt="" /><figcaption class="card-body">' . $post["commentaire"] . '</figcaption></figure>';
                                } else if ($media[$i]["typeMedia"] == "video/mp4" || $media[$i]["typeMedia"] == "video/wmv" || $media[$i]["typeMedia"] == "image/mov" || $media[$i]["typeMedia"] == "video/avi") {
                                    echo '<figure><video class="card-img-top" width="1080" height="720" autoplay controls loop><source src="upload/' . $media[$i]["nomFichierMedia"] . '" type="' . $media[$i]["typeMedia"] . '"></video><figcaption class="card-body">' . $post["commentaire"] . '</figcaption></figure>';
                                } else {
                                    echo '<figure><audio class="card-img-top" controls><source src="upload/' . $media[$i]["nomFichierMedia"] . '" type="' . $media[$i]["typeMedia"] . '"></audio><figcaption class="card-body">' . $post["commentaire"] . '</figcaption></figure>';
                                }
                            }
                            echo '<a href="index.php?delete=true&idPost='. $idPost .'" class="card-footer">Supprimer</a></div></div>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
