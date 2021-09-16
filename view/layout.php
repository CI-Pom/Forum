<?php
    use App\Service\Session;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <title>Exo Forum</title>
</head>
<body>
    <div id="wrapper">
        <header>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="?ctrl=home&action=listCategories">Forum</a>
                <?php
                if(Session::getUser()){ ?>
                    <a href="?ctrl=security&action=profil&id=<?= Session::getUser()->getId() ?>">Profil</a>
                    <a href="?ctrl=security&action=logout">Déconnexion</a>
                <?php } else {
                    ?>
                    <a href="?ctrl=security&action=login">Connexion</a>
                    <a href="?ctrl=security&action=register">Inscription</a>
                <?php } 
                if (Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
                        <a href="?ctrl=admin">Admin</a>
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
    </div>
</body>
</html> 