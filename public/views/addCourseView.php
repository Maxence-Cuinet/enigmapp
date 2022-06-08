<?php
AuthController::redirectIfNotLogged(true);
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
    if (!$course) {
        header("Location: /add-course");
    }
}

$imgSelected = $course ? basename($course->getUrlImg()) : 'sherlock.jpg';
$imgSelected = in_array($imgSelected, ['sherlock.jpg', 'eye.jpg', 'globe.png']) ? $imgSelected : 'sherlock.jpg';
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<script src="/js/imgSelector.js"></script>
<script src="/js/addStep.js"></script>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <h3>Création d'un jeu de piste</h3>
    <form class="mt-4 mb-5" action="/add-course/submit" method="post">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nom du jeu de piste *</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $course ? $course->getName() : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Image</label>
            <div class="mb-3 d-flex">
                <img src="/img/sherlock.jpg" class="img-selection <?= $imgSelected === 'sherlock.jpg' ? 'img-selected' : '' ?> img-thumbnail me-3" alt="...">
                <img src="/img/eye.jpg" class="img-selection <?= $imgSelected === 'eye.jpg' ? 'img-selected' : '' ?> img-thumbnail me-3" alt="...">
                <img src="/img/globe.png" class="img-selection <?= $imgSelected === 'globe.png' ? 'img-selected' : '' ?> img-thumbnail me-3" alt="...">
            </div>
            <input type="hidden" id="image" name="image" value="<?= $course ? $course->getUrlImg() : '/img/sherlock.jpg' ?>">
<!--            <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">-->
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= $course ? $course->getDescription() : '' ?></textarea>
        </div>
        <div class="mb-3">
            <button id="btnAddStep" class="btn btn-outline-success"><i class="fa fa-plus"></i> Ajouter une étape</button>
        </div>
        <input type="hidden" id="courseId" name="courseId" value="<?= $course ? $course->getId() : '' ?>">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</section>

<?php include_once __DIR__ . '/../partials/addStepModal.php' ?>
<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
