<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container">
    <form class="authForm m-auto" action="/connection/login" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Email ou nom d'utilisateur</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <div class="mt-3">
            <a href="/register" class="text-decoration-none">Pas encore de compte ?</a>
            <a href="/forget-password" class="text-decoration-none ms-4">Mot de passe oublié ?</a>
        </div>
        <div class="mt-3">
        </div>
    </form>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
