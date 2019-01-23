<?php 

require_once 'functionDB.inc.php';

$arrPost = getAllPost();
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
                echo '<figure><img src="'. $post["nomMedia"] .'" alt="" /><figcaption>'.'</figcaption></figure>';
            }
            ?>
        </div>
    </body>
</html>
