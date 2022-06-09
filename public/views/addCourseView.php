<?php
AuthController::redirectIfNotLogged(true);
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
    $steps = Step::findAllByCourseId($course->getId());
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
        <div class="mb-3 <?php echo !isset($steps) ? 'hide-custom' : ''; ?>" id="divStepTable">
            <table class="table table-bordered" id="stepTable" data-count="0">
                <thead>
                    <tr>
                        <th>N° de l'étape</th>
                        <th>Nom de l'étape</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($steps)){
                            foreach($steps as $index=>$step) {
                                $answers = Answer::findAllByStepId($step->getId());
                    ?>
                                <tr id="step_<?php echo $step->getId(); ?>">
                                    <td><span class="num-step"><?php echo $index+1 ?></span></td>
                                    <td><a href="javascript:void(0)" class="change-step" data-id="<?php echo $step->getId(); ?>" data-name="<?php echo $step->getName(); ?>" data-description="<?php echo $step->getDescription(); ?>" data-question="<?php echo $step->getQuestion(); ?>" data-answer1="<?php echo $answers[0]->getLibelle(); ?>" data-answer2="<?php echo $answers[1]->getLibelle(); ?>" data-answer3="<?php echo $answers[2]->getLibelle(); ?>"><?php echo $step->getName(); ?></a></td>
                                    <td><a href="javascript:void(0)" class="remove-step"><i class="fa fa-times fa-xl text-danger"></i></a></td>
                                </tr>
                    <?php 
                            }
                        }   
                    ?>
                </tbody>
            </table>
        </div>
        <div class="d-none" id="divStepHidden">

        </div>
        <input type="hidden" id="courseId" name="courseId" value="<?= $course ? $course->getId() : '' ?>">
        <button type="submit" class="btn btn-primary"><?php echo isset($_GET['courseId']) ? "Modifier" : "Ajouter" ?></button>
    </form>
</section>

<?php include_once __DIR__ . '/../partials/addStepModal.php' ?>
<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
