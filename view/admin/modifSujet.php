<?php
    $sujet = $response["data"]["sujet"];
    $categories = $response["data"]["categories"];
?>
<a href="?ctrl=admin&action=listSujets">Retour</a>

<h1>Déplacer le Sujet de Categorie</h1>

<form action="?ctrl=admin&action=deplacerSujet&id=<?= $sujet->getId() ?>" method="POST">
    <p>
        <h3><?= $sujet->getTitre() ?></h3>
    </p>
    <p>
        <label for="categorie">Nouvelle Catégorie</label> <br>
        <select name="categorie" id="">
            <?php foreach ($categories as $categorie) { ?>
                <option value="<?= $categorie->getId() ?>"><?= $categorie->getTitre() ?></option>
            <?php } ?>
        </select>  
    </p>
    <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
    <input type="submit" value="Déplacer" class="button">
</form>