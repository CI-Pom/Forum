<?php
    use App\Service\Session;
    $sujet = $response["data"]["sujet"];
    $messages = $response["data"]["messages"];
?>

<h1><?= $sujet->getTitre() ?></h1>

<div>
    <table>
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
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div>
<?php if(Session::getUser()){ ?>
    <form action="?ctrl=forum&action=nouveauMessage&id=<?= $sujet->getId() ?>" method="post">
        <p>
            <label for="text">Votre Message</label><br>
            <textarea name="text" id="" cols="30" rows="10"></textarea>
        </p>
        <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
        <input type="submit" value="Répondre">
    </form>
<?php } else { ?>
    <p>Veuillez vous connecter/inscrire pour répondre</p>
<?php } ?>
</div>