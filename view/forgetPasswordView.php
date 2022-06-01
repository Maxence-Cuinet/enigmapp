<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container">
    <form class="authForm m-auto" action="/forget-password/send-mail" method="post">
        <?php if (isset($_POST['mail_send']) && $_POST['mail_send']) { ?>
            <div class="alert alert-success" role="alert">
                Email envoyé avec succés !
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="text" class="form-control" id="mail" name="mail" required>
        </div>
        <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
        <div class="mt-3">
            <a href="/connection" class="text-decoration-none">Mot de passe retrouvé ?</a>
        </div>
    </form>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
