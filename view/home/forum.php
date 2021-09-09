<?php
    $categories = $response["data"]["categories"];
?>

<h1>Forum</h1>

<div>
<?php
    foreach($categories as $categorie){ ?>
    <a href="?ctrl=home&action=detailsCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getTitre() ?></a><br>
<?php }
?>
</div>