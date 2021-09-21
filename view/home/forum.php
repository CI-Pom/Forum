<?php
use App\Service\Session;
    $categories = $response["data"]["categories"];
?>

<h1>Forum</h1>

<div>
    <p>
        <table>
            <thead>
                <tr>
                    <td>Catégorie</td>
                    <td>Nb Sujets</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($categories as $categorie){ ?>
                    <tr>
                        <td><a href="?ctrl=home&action=detailsCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getTitre() ?></a></td>
                        <td><?= $categorie->getnbSujets() ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    
    </p>
<?php if (Session::isRoleUser("ROLE_ADMIN")) { ?>
    <form action="?ctrl=forum&action=nouvelleCategorie" method="POST">
        <p>
            <label for="titre">Nouvelle catégorie</label> <br>
            <input type="text" name="titre" id="" required>
        </p>    
        <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
        <input type="submit" value="Ajouter" class="button">
    </form>
<?php } ?>
</div>