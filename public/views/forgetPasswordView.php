<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form class="authForm m-auto" action="/forget-password/send-mail" method="post">
        <?php include_once __DIR__ . '/../template/displayErrorsSuccess.php' ?>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
        <div class="mt-3">
            <a href="/connection" class="text-decoration-none">Mot de passe retrouvé ?</a>
        </div>
    </form>
</section>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
