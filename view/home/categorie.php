<?php
    $categorie = $response["data"]["categorie"];
    $sujets = $response["data"]["sujets"];
?>

<h1><?= $categorie->getTitre() ?></h1>



<div>
    <table>
        <thead>
            <tr>
                <td>Sujet</td>
                <td>Créé par</td>
                <td>Créé le</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($sujets as $sujet){ ?>
                <tr>
                    <td><a href=""><?= $sujet->getTitre() ?></a></td>
                    <td><?= $sujet->getUtilisateur() ?></td>
                    <td><?= $sujet->getCreatedAt() ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>