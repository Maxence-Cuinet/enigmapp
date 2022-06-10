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
        <!-- @todo mettre ça dans une modale qui s'ouvre avec un bouton -->
        <div>
            <h4 class="mb-4">Quiz</h4>
            <p><?= $steps[$actualStep]->getQuestion() ?></p>
            <?php
            $answers = Answer::findAllByStepId($steps[$actualStep]->getId());
            foreach ($answers as $answer) {
                ?>
                <button type="button" class="btn btn-outline-dark me-3 answer"><?= $answer->getLibelle() ?></button>
            <?php } ?>
        </div>
    </form>
</section>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
