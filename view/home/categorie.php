<?php
    use App\Service\Session;
    $categorie = $response["data"]["categorie"];
    $sujets = $response["data"]["sujets"];
?>

<a href="?ctrl=home&action=listCategories">Forum</a> <i class="fas fa-long-arrow-alt-right"></i> <a href=""><?= $categorie->getTitre() ?></a>

<h1><?= $categorie->getTitre() ?></h1>

<?php if(Session::getUser()){ ?>
    <a href="?ctrl=home&action=newSujet&id=<?= $categorie->getId() ?>">Créer un nouveau sujet</a>
<?php } else { ?>
    <p>Veuillez vous connecter/inscrire pour créer un nouveau sujet</p>
<?php } ?>

<div>
    <table id="sujets">
        <thead>
            <tr>
                <td>Sujet</td>
                <td>Créé par</td>
                <td>Créé le</td>
                <td>nb Messages</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($sujets as $sujet){ ?>
                <tr>
                    <td><a href="?ctrl=home&action=detailsSujet&id=<?= $sujet->getId() ?>"><?= $sujet->getTitre() ?></a></td>
                    <td><?= $sujet->getUtilisateur() ?></td>
                    <td><?= $sujet->getCreatedAt() ?></td>
                    <td><?= $sujet->getNbMessages() ?></td>
                    <?php if (Session::getUser() == $sujet->getUtilisateur() || Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
                        <td><a href="?ctrl=forum&action=supprimerSujet&id=<?= $sujet->getId() ?>"><i class="far fa-trash-alt"></i></a></td>
                    <?php } ?>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>