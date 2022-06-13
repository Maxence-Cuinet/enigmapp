<?php
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
}
if (!$course) {
    header("Location: /");
}

$steps = Step::findAllByCourseId($course->getId());
$nbStep = count($steps);
$actualStep = $_POST['participation']['actualStep'] < $nbStep ? $steps[$_POST['participation']['actualStep']] : null;

if (!$actualStep) {
    $actualStep->courseFinish();
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<script src="/js/quiz.js">
    test = 'bonjour'
</script>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container">
    <?php if ($actualStep) { ?>
        <form action="/course/participate?courseId=<?= $course->getId() ?>" method="post">
            <h3 class="mb-4"><?= $course->getName() ?></h3>
            <h4 class="mb-4"><?= $actualStep->getName() ?></h4>
            <img src="<?= $actualStep->getUrlImg() ?>" class="rounded mb-4 bg-white" height="220" alt="...">
            <div class="alert alert-light mb-5">
                <?= $actualStep->getDescription() ?>
            </div>
            <div class="alert alert-success d-none win-alert" role="alert">
                Bravo ! C'était la bonne réponse ! <br>
                Tu peux passer à la prochaine étape.
            </div>
            <div class="alert alert-danger d-none lose-alert" role="alert">
                Dommage... Tu n'as pas réussi à trouver la bonne réponse. <br>
                Tu feras peut-être mieux avec la prochaine étape.
            </div>
            <button type="button" class="btn btn-primary btn-lg btn-quiz" data-bs-toggle="modal" data-bs-target="#quizModal">Afficher le Quiz !</button>
            <button type="submit" class="btn btn-primary btn-lg d-none btn-next-step" name="next-step"
                    value="<?= $_POST['participation']['actualStep'] + 1 ?>">Prochaine étape</button>
        </form>
    <?php } else { ?>
        <div class="alert alert-success win-alert" role="alert">
            <h3>Félicitation !</h3>
            Tu as terminé le jeu de piste : <strong><?= $course->getName() ?></strong><br>
            Ton score est de ***
        </div>
        <a type="button" class="btn btn-primary btn-lg" href="/">Retour à la liste des jeux de pistes</a>
    <?php } ?>
</section>

<div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizModalLabel"><?= $actualStep->getQuestion() ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted text-center">
                <div class="alert alert-warning d-none first-error-alert" role="alert">
                    Ce n'est pas la bonne réponse ! Tu as encore 1 essai.
                </div>
                <?php
                $answers = Answer::findAllByStepId($actualStep->getId());
                shuffle($answers);
                foreach ($answers as $answer) {
                    ?>
                    <button type="button" class="btn btn-outline-info btn-lg me-3 answer" data-id="<?= $answer->getId() ?>"
                            data-step-id="<?= $actualStep->getId() ?>"><?= $answer->getLibelle() ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
