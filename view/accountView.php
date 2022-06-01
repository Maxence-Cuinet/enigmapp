<?php
AuthController::redirectIfNotLogged();
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container">
    <h3>Informations du compte</h3>
    <form class="my-4">
        <div class="mb-3 row">
            <label for="username" class="col-sm-4 col-form-label fw-bold">Nom d'utilisateur</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username" value="<?= $_SESSION['user']['username'] ?>" disabled>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="mail" class="col-sm-4 col-form-label fw-bold">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="mail" name="mail" value="<?= $_SESSION['user']['mail'] ?>" disabled>
            </div>
        </div>
    </form>
    <a class="btn btn-primary" href="/change-password">Changer de mot de passe</a>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
