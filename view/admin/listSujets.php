<?php
    $sujets = $response["data"]["sujets"];
?>
<a href="?ctrl=admin">Retour</a>

<h1>Liste des Sujets</h1>

<table>
    <thead>
        <tr>
            <td>Sujet</td>
            <td>Catégorie</td>
            <td>créé le</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sujets as $sujet) { ?>
            <tr>
                <td><?= $sujet->getTitre() ?></td>
                <td><?= $sujet->getCategorie()->getTitre() ?></td>
                <td><?= $sujet->getCreatedAt() ?></td>
                <td><a href="?ctrl=admin&action=modifSujet&id=<?= $sujet->getId() ?>">déplacer</a></td>
                <td><a href="?ctrl=forum&action=supprimerSujet&id=<?= $sujet->getId() ?>"><i class="far fa-trash-alt"></i></a></td>
            </tr>    
        <?php } ?>
    </tbody>
</table>