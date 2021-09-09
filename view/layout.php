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
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="?ctrl=home&action=listCategories">Forum</a>
            <?php
            if(Session::getUser()){
                ?>
                <a href="?ctrl=security&action=logout">Déconnexion</a>
            <?php } else {
                ?>
                <a href="?ctrl=security&action=login">Connexion</a>
                <a href="?ctrl=security&action=register">Inscription</a>
            <?php } ?>
        </nav>
    </header>
    <section>
        <?php
            foreach(Session::getMessages("success") as $message){
                ?>
                <div><?= "SUCCESS : ".$message ?></div>
                <?php
            }
            foreach(Session::getMessages("error") as $message){
                ?>
                <div><?= "ERROR : ".$message ?></div>
                <?php
            }
        ?>
    </section>

    <?= $content ?>
    
    <footer>Coralie 2021</footer>

</body>
</html> 