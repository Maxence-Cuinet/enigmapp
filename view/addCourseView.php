<?php
AuthController::redirectIfNotLogged(true);
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container">
    <h3>Création d'un jeu de piste</h3>
    <form class="mt-4 mb-5" action="/add-course/submit" method="post">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nom du jeu de piste *</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
