<?php
    $utilisateurs = $response["data"]["utilisateurs"];
?>
<a href="?ctrl=admin">Retour</a>

<h1>Bannir un utilisateur</h1>

<form action="" method="POST">
    <p>
        <label for="utilisateur">Utilisateurs :</label> <br>
        <select name="utilisateur" id="">
            <?php foreach ($utilisateurs as $user) { ?>
                <option value="<?= $user->getId() ?>"><?= $user->getUsername() ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="dateFin">Jusqu'au :</label>
        <input type="date" name="dateFin" id="">
    </p>
    <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
    <input type="submit" value="Bannir" class="button">
</form>