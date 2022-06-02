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
    <form class="mt-4 mb-5">
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
    <div class="mb-4">
        <a class="btn btn-primary" href="/change-password">Changer de mot de passe</a>
    </div>
    <div class="mb-5">
        <a class="btn btn-danger" href="/logout">Déconnexion</a>
    </div>
    <hr>
    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
        Supprimer définitivement le compte
    </button>
</section>

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Suppression définitive du compte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted">
                <p>
                    L'ensemble des données de votre compte sera effacé de nos bases de données
                    et aucune récupération ne sera possible.
                </p>
                <p>
                    Êtes-vous sûr de vouloir supprimer définitivement votre compte ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a class="btn btn-danger" href="/delete">Valider la suppression</a>
            </div>
        </div>
    </div>
</div>

<?php include_once('template/footer.php') ?>
</body>
</html>
