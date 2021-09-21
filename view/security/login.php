
<h1>Connexion</h1>

<form action="?ctrl=security&action=login" method="post">
    <p>
        <input type="email" name="email" id="" placeholder="E-Mail..." required>
    </p>
    <p>
        <input type="password" name="password" id="" placeholder="Mot de Passe..." required>
    </p>
    <input type="hidden" name="crsf_token" value="<?= $csrf_token ?>">
    <p>
        <input type="submit" value="Connexion" class="button">
    </p>
</form>