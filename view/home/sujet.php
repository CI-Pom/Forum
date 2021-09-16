<?php
    use App\Service\Session;
    $sujet = $response["data"]["sujet"];
    $messages = $response["data"]["messages"];
    $categorie = $sujet->getCategorie();
    $locked = $sujet->getLocked();
?>

<a href="?ctrl=home&action=listCategories">Forum</a> <i class="fas fa-long-arrow-alt-right"></i> <a href="?ctrl=home&action=detailsCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getTitre() ?></a> <i class="fas fa-long-arrow-alt-right"></i> <a href="?ctrl=home&action=detailsSujet&id=<?= $sujet->getId() ?>"><?= $sujet->getTitre() ?></a>

<h1><?= $sujet->getTitre() ?></h1>

<div>
    <table id="messages">
        <thead>
            <tr>
                <td>Utilisateur</td>
                <td>Message</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message) { ?>
                <tr>
                    <td>
                        <?= $message->getUtilisateur() ?>
                    </td>
                    <td>
                        <p><?= $message->getText() ?></p>
                        <p><?= $message->getCreatedAt() ?></p>
                    <?php
                        if ($locked == "no") {
                            if(($message->getUtilisateur() == Session::getUser()) || Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")){ ?>
                            <a href="?ctrl=home&action=formModifMessage&id=<?= $message->getId() ?>"><i class="far fa-edit"></i></a>
                        <?php } }
                        if (Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
                            <a href="?ctrl=forum&action=supprimerMessage&id=<?= $message->getId() ?>"><i class="far fa-trash-alt"></i></a>
                        <?php } 
                         ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div>
<?php
    if(Session::getUser()){ 
        if ($locked == "yes") { ?>
            <p>Ce sujet est clos !</p>
        <?php if (Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
            <a href="?ctrl=forum&action=cloreSujet&id=<?= $sujet->getId() ?>">Rouvrir le sujet</a>
        <?php }    
        } 
        else {
            if ($sujet->getUtilisateur() == Session::getUser() || Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
            <a href="?ctrl=forum&action=cloreSujet&id=<?= $sujet->getId() ?>">Clore le sujet</a>
        <?php } ?>
            <form action="?ctrl=forum&action=nouveauMessage&id=<?= $sujet->getId() ?>" method="post">
                <p>
                    <label for="text">Votre Message</label><br>
                    <textarea name="text" id="" cols="30" rows="10" required></textarea>
                </p>
                <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
                <input type="submit" value="Répondre">
            </form>
<?php   
        } 
    } 
    else { ?>
        <p>Veuillez vous connecter/inscrire pour répondre</p>
<?php } ?>
</div>