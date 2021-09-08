<?php
    use App\Service\Session;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Exo Forum</title>
</head>
<body>
    
    <nav>
        <a href="">Accueil</a>
        <?php
        if(Session::getUser()){
            ?>
            <a href="">Déconnexion</a>
        <?php } else {
            ?>
            <a href="">Connexion</a>
            <a href="">Inscription</a>
        <?php } ?>
    </nav>

    <?= $content ?>
    
    <footer>Coralie 2021</footer>

</body>
</html> 