<?php
    $user = $response["data"]["user"];
?>

<h1>Modifier Votre profil :</h1>

<form action="" method="POST">
    <p>
        <label for="username">Username</label> <br>
        <input type="text" name="username" id="" value="<?= $user->getUsername() ?>" required>
    </p>
    <p>
        <label for="email">E-mail</label> <br>
        <input type="email" name="email" id="" value="<?= $user->getEmail() ?>" required>
    </p>
    <p>
        <label for="biographie">Biographie</label> <br>
        <textarea name="biographie" id="" cols="50" rows="10"><?= $user->getBiographie() ?></textarea>
    </p>
    <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
    <input type="submit" value="Modifier">
</form>