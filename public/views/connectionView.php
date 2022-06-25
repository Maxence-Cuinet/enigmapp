<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form class="authForm m-auto" action="/connection/login<?= isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : '' ?>" method="post">
        <?php include_once __DIR__ . '/../template/displayErrorsSuccess.php' ?>
        <div class="mb-3">
            <label for="login" class="form-label">Email ou nom d'utilisateur</label>
            <input type="text" class="form-control" id="login" name="login" value="<?= $_POST['login'] ?? null ?>" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <div class="mt-3 d-flex flex-column flex-sm-row">
            <a href="/register" class="text-decoration-none me-4 mb-2">Pas encore de compte ?</a>
            <a href="/forget-password" class="text-decoration-none">Mot de passe oublié ?</a>
        </div>
        <div class="mt-3">
        </div>
    </form>
</section>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
