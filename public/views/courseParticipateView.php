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
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <form>
        <h3 class="mb-4"><?= $course->getName() ?></h3>
        <h4 class="mb-4"><?= $steps[$actualStep]->getName() ?></h4>
        <img src="<?= $steps[$actualStep]->getUrlImg() ?>" class="rounded mb-4 bg-white" height="270" alt="...">
        <div class="alert alert-light mb-5">
            <?= $steps[$actualStep]->getDescription() ?>
        </div>
        <h4 class="mb-4">Quiz</h4>
        <p><?= $steps[$actualStep]->getQuestion() ?></p>
        <?php
        $answers = Answer::findAllByStepId($steps[$actualStep]->getId());
        foreach ($answers as $answer) {
        ?>
            <a type="button" class="btn btn-outline-dark me-3"><?= $answer->getLibelle() ?></a>
        <?php } ?>
    </form>
</section>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
