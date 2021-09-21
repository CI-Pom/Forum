<?php
    $categorie = $response["data"]["categorie"];
?>

<a href="?ctrl=home&action=detailsCategorie&id=<?= $categorie->getId() ?>">Retour</a>

<h1>Créer un nouveau sujet</h1>

<h2>dans la catégorie : <?= $categorie->getTitre() ?></h2>

<form action="?ctrl=forum&action=nouveauSujet&id=<?= $categorie->getId() ?>" method="post">
        <p>
            <label for="titre">Nouveau Sujet</label><br>
            <input type="text" name="titre" id="" required>
        </p>
        <p>
            <textarea name="text" id="" cols="30" rows="10" required></textarea>
        </p>
        <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
        <input type="submit" value="Ajouter" class="button">
</form>