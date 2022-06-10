<?php
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
}
if (!$course) {
    header("Location: /");
}

$steps = Step::findAllByCourseId($course->getId());
$actualStep = $_POST['participation']['actualStep'];
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<script src="/js/quiz.js"></script>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form>
        <h3 class="mb-4"><?= $course->getName() ?></h3>
        <h4 class="mb-4"><?= $steps[$actualStep]->getName() ?></h4>
        <img src="<?= $steps[$actualStep]->getUrlImg() ?>" class="rounded mb-4 bg-white" height="220" alt="...">
        <div class="alert alert-light mb-5">
            <?= $steps[$actualStep]->getDescription() ?>
        </div>
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#quizModal">Afficher le Quiz !</button>
    </form>
</section>

<div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizModalLabel"><?= $steps[$actualStep]->getQuestion() ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted text-center">
                <?php
                $answers = Answer::findAllByStepId($steps[$actualStep]->getId());
                shuffle($answers);
                foreach ($answers as $answer) {
                    ?>
                    <button type="button" class="btn btn-outline-info btn-lg me-3 answer"><?= $answer->getLibelle() ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
