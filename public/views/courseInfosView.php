<?php
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
}
if (!$course) {
    header("Location: /");
}

$thisCourseIsInProgress = false;
$participationInProgress = Participation::findInProgressByUserId($_SESSION['user']['id']);
if ($participationInProgress && $participationInProgress->getCourseId() === $course->getId()) {
    $thisCourseIsInProgress = true;
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form>
        <h3 class="mb-4"><?= $course->getName() ?></h3>
        <img src="<?= $course->getUrlImg() ?>" class="rounded mb-4 bg-white" height="270" alt="...">
        <div class="alert alert-light">
            <?= $course->getDescription() ?>
        </div>
        <div>
            <small class="text-muted">Ce jeu de piste contient <?= Step::countByCourseId($course->getId()) ?> étapes</small>
            <small class="float-end text-muted">Dernière modification le <?= $course->getUpdatedAt()->format('d/m/Y à H:i') ?></small>
        </div>
        <a type="button" <?= $participationInProgress && !$thisCourseIsInProgress ? 'data-bs-toggle="modal" data-bs-target="#courseInProgressModal"' : 'href="/course/participate?courseId=' . $course->getId() . '"' ?> class="btn btn-primary mt-5"><?= $thisCourseIsInProgress ? 'Reprendre le jeu' : 'Confirmer la participation' ?></a>
    </form>
</section>

<div class="modal fade" id="courseInProgressModal" tabindex="-1" aria-labelledby="courseInProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseInProgressModalLabel">Voulez-vous abandonner la partie en cours ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted">
                Vous avez déjà un jeu de piste en cours. (voir sur la page d'acueil) <br>
                Voulez-vous quand même participer à ce jeu de piste et abandonner la partie en cours ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a class="btn btn-danger" href="/course/participate?courseId=<?= $course->getId() ?>">Abandonner la partie</a>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
