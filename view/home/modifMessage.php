<?php
    $message = $response["data"]["message"];
?>

<h2>Modifier votre message</h2>

<form action="?ctrl=forum&action=modifierMessage&id=<?= $message->getId() ?>" method="post">
    <p>
        <label for="text">Votre Message</label><br>
        <textarea name="text" id="" cols="30" rows="10" required><?= $message->getText() ?></textarea>
    </p>
    <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
    <input type="submit" value="Modifier">
</form>