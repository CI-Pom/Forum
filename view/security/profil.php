<?php
    $user = $response["data"]["user"];
?>

<h1>Profil de <?= $user->getUsername() ?> </h1>

<p>
    E-mail : <?= $user->getEmail() ?> <br>
    Inscrit depuis le : <?= $user->getCreatedAt() ?> <br>
    Ma petite bio : <?= $user->getBiographie() ?> <br>
    Rôle : <?= $user->getRole() ?>
</p>

<p>
    <a href="?ctrl=security&action=modifierProfil&id=<?= $user->getId() ?>"><i cl<i class="fas fa-user-edit"></i> Modifier ma biographie</a> <br>
    <a href="?ctrl=security&action=supprimerUtilisateur&id=<?= $user->getId() ?>"><i class="far fa-trash-alt"></i> Supprimer mon Compte</a>
</p>