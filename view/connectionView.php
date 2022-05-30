<html lang="fr">
<?php include_once('template/htmlHead.php') ?>
<body>
<div class="container">
    <form id="registerForm" action="/connection/login" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">E-mail ou nom d'utilisateur</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>

</body>
</html>
