
<h1>Inscription</h1>

<form action="?ctrl=security&action=register" method="post">
    <p>
        <input type="text" name="username" id="" placeholder="Username..." required>
    </p>
    <p>
        <input type="email" name="email" id="" placeholder="E-Mail..." required>
    </p>
    <p>
        <input type="password" name="password" id="" placeholder="Mot de Passe..." required>
    </p>
    <p>
        <input type="password" name="password_repeat" id="" placeholder="Répéter le Mot de Passe..." required>
    </p>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <p>
        <input type="submit" value="Inscription">
    </p>
</form>