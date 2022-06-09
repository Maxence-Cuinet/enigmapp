<?php
if (!isset($_GET['user_id']) || !isset($_GET['secret_key'])) {
    AuthController::redirectIfNotLogged();
} else {
    $dateNow = new DateTime();
    $timezone = new DateTimeZone('Europe/Paris');
    $dateNow->setTimezone($timezone);

    $user = User::findById($_GET['user_id']);
    if (!$user || $_GET['secret_key'] !== $user->getSecretKey()) {
        $_POST['errors'][] = "Utilisateur introuvable.";
    } else if (strtotime($user->getGenerateKeyDate()->add(new DateInterval('PT30M'))->format('Y-m-d H:i:s')) - strtotime($dateNow->format('Y-m-d H:i:s')) < 0) {
        $_POST['errors'][] = "Ce lien a expiré.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<script src="/js/formValidator.js"></script>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form class="authForm m-auto" action="/change-password/update" method="post">
        <?php include_once __DIR__ . '/../template/displayErrorsSuccess.php' ?>
        <?php if (AuthController::isLogged()) { ?>
            <div class="mb-3">
                <label for="actualPassword" class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-control" id="actualPassword" name="actualPassword" required autofocus>
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" required autofocus>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
        <div class="invisible">
            <label><input id="userId" name="userId" value="<?= $_GET['user_id'] ?? null ?>"></label>
            <label><input id="secretKey" name="secretKey" value="<?= $_GET['secret_key'] ?? null ?>"></label>
        </div>
    </form>
</section>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
