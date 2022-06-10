<?php
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
}
if (!$course) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form action="/course/participate">
        <h3 class="mb-4"><?= $course->getName() ?></h3>
        <img src="<?= $course->getUrlImg() ?>" class="rounded mb-4" height="270" alt="...">
        <div class="alert alert-light">
            <?= $course->getDescription() ?>
        </div>
        <div>
            <small class="text-muted">Ce jeu de piste contient <?= Step::countByCourseId($course->getId()) ?> étapes</small>
            <small class="float-end text-muted">Dernière modification le <?= $course->getUpdatedAt()->format('d/m/Y à H:i') ?></small>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Confirmer la participation</button>
    </form>
</section>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
