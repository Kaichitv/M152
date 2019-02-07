<?php 

require_once 'functionDB.inc.php';

$arrPost = getAllPost();
$arrMedia = getAllMedia();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="post.php">Post</a>
        </nav>
        <div>
            <img src="img/photoprofil.jpg" alt=""/>
            <p>Bienvenu</p>
            <?php 
            foreach ($arrPost as $post) {
                foreach ($arrMedia as $media){
                echo '<figure><img src="upload/'. $media["nomFichierMedia"] .'" alt="" /><figcaption>'. $post["commentaire"] .'</figcaption></figure>';
            }}
            var_dump($post);
            ?>
        </div>
    </body>
</html>
