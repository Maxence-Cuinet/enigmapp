<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<script src="/view/js/formValidator.js"></script>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container">
    <form class="authForm" action="/register/submit" method="post">
        <?php include_once('template/displayErrorsSuccess.php') ?>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" value="<?= $_POST['mail'] ?? null ?>" required autofocus>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $_POST['username'] ?? null ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin" value="true">
            <label class="form-check-label" for="isAdmin">
                Créateur de contenu ?
            </label>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
        <div class="mt-3">
            <a href="/connection" class="text-decoration-none">Déjà un compte ?</a>
        </div>
    </form>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
