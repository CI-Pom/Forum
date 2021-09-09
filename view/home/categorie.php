<?php
    use App\Service\Session;
    $categorie = $response["data"]["categorie"];
    $sujets = $response["data"]["sujets"];
?>

<h1><?= $categorie->getTitre() ?></h1>

<?php if(Session::getUser()){ ?>
    <form action="?ctrl=forum&action=nouveauSujet&id=<?= $categorie->getId() ?>" method="post">
        <p>
            <label for="titre">Nouveau Sujet</label><br>
            <input type="text" name="titre" id="">
        </p>
        <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
        <input type="submit" value="Ajouter">
    </form>
<?php } else { ?>
    <p>Veuillez vous connecter/inscrire pour créer un nouveau sujet</p>
<?php } ?>

<div>
    <table>
        <thead>
            <tr>
                <td>Sujet</td>
                <td>Créé par</td>
                <td>Créé le</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($sujets as $sujet){ ?>
                <tr>
                    <td><a href="?ctrl=home&action=detailsSujet&id=<?= $sujet->getId() ?>"><?= $sujet->getTitre() ?></a></td>
                    <td><?= $sujet->getUtilisateur() ?></td>
                    <td><?= $sujet->getCreatedAt() ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>