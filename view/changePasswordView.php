<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<script src="/view/js/formValidator.js"></script>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container">
    <form class="authForm m-auto" action="/change-password/update" method="post">
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
        <input class="invisible" id="userId" name="userId" value="<?= $_GET['user_id'] ?? null ?>" required>
    </form>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
