<?php
use App\Service\Session;
$utilisateurs = $response["data"]["utilisateurs"];
?>

<a href="?ctrl=admin">Retour</a>

<h1>Liste des Utilisateurs du forum</h1>

<table>
    <thead>
        <tr>
            <td>Utilsateur</td>
            <td>E-mail</td>
            <td>Inscrit le</td>
            <td>Rôle</td>
            <?php if (Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
                <td>nb de Ban</td>
                <td></td>
            <?php } ?>
            <?php if (Session::isRoleUser("ROLE_ADMIN")) { ?>
                <td></td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $user) { ?>
            <tr>
                <td><?= $user->getUsername() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getCreatedAt() ?></td>
                <td><?= $user->getRole() ?></td>
                <?php if (Session::isRoleUser("ROLE_ADMIN") || Session::isRoleUser("ROLE_MODO")) { ?>
                    <td></td>
                    <td><a href="?ctrl=security&action=supprimerUtilisateur&id=<?= $user->getId() ?>"><i class="fas fa-user-slash"></i></a></td>
                <?php } ?>
                <?php if (Session::isRoleUser("ROLE_ADMIN")) { ?>
                    <td><a href="?ctrl=admin&action=modifierRole&id=<?= $user->getId() ?>"><i class="fas fa-user-edit"></i></a></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>