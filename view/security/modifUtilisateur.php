<?php
    $user = $response["data"]["user"];
?>

<h1>Modifier votre biographie :</h1>

<form action="?ctrl=security&action=updateProfil&id=<?= $user->getId() ?>" method="POST">
    <p>
        <label for="biographie">Biographie</label> <br>
        <textarea name="biographie" id="" cols="50" rows="10"><?= $user->getBiographie() ?></textarea>
    </p>
    <!-- <p>
        <label for="avatar">Votre avatar</label> <br>
        <input type="file" name="avatar" id="" accept="image/png, image/jpeg">
    </p> -->
    <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
    <input type="submit" value="Modifier">
</form>