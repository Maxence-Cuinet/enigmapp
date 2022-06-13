<?php
AuthController::redirectIfNotLogged(true);
$course = null;
if (isset($_GET['courseId'])) {
    $course = Course::findById($_GET['courseId']);
    
    if (!$course) {
        header("Location: /course/create");
    } else {
       $steps = Step::findAllByCourseId($course->getId()); 
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
    <form class="mt-4 mb-5" action="/course/create/submit" method="post">
        <?php include_once __DIR__ . '/../template/displayErrorsSuccess.php' ?>
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
            <button id="btnAddStep" class="btn btn-outline-success" <?php echo isset($steps) ? (count($steps) > 9 ? 'disabled' : '') : ''; ?>><i class="fa fa-plus"></i> Ajouter une étape</button>
            <br><i id="infoMaxEtape" class="<?php echo isset($steps) ? (count($steps) > 9 ? '' : 'hide-custom') : 'hide-custom'; ?>">Nombre maximum d'étape atteint</i>
        </div>
        <div class="mb-3 <?php echo !isset($steps) || count($steps) == 0 ? 'hide-custom' : ''; ?>" id="divStepTable">
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
                            foreach($steps as $step) {
                                $answers = Answer::findAllByStepId($step->getId());
                    ?>
                                <tr id="step_<?php echo $step->getId(); ?>">
                                    <td><span class="num-step"><?php echo $step->getOrder() ?></span></td>
                                    <td><a href="javascript:void(0)" class="change-step" data-id="<?php echo $step->getId(); ?>" data-order="<?php echo $step->getOrder(); ?>" data-name="<?php echo $step->getName(); ?>" data-description="<?php echo $step->getDescription(); ?>" data-question="<?php echo $step->getQuestion(); ?>" data-answer1="<?php echo $answers[0]->getLibelle(); ?>" data-answer2="<?php echo $answers[1]->getLibelle(); ?>" data-answer3="<?php echo $answers[2]->getLibelle(); ?>" data-indice="<?php echo $step->getIndice(); ?>" ><?php echo $step->getName(); ?></a></td>
                                    <td><a href="javascript:void(0)" data-id="<?php echo $step->getId(); ?>" class="remove-step"><i class="fa fa-times fa-xl text-danger"></i></a></td>
                                </tr>
                    <?php 
                            }
                        }   
                    ?>
                </tbody>
            </table>
        </div>
        <div class="d-none" id="divStepHidden">
            <?php 
                if(isset($steps)){
                    foreach($steps as $index=>$step) {
                        $answers = Answer::findAllByStepId($step->getId());
                        $val = json_encode([
                            "order" => $step->getOrder(),
                            "name" => $step->getName(),
                            "description" => $step->getDescription(),
                            "question" => $step->getQuestion(),
                            "url_img" => '/img/step.png', // Upload d'image non géré
                            "answer1" => $answers[0]->getLibelle(),
                            "answer2" => $answers[1]->getLibelle(),
                            "answer3" => $answers[2]->getLibelle(),
                            "indice" => $step->getIndice()
                        ]);
            ?>
                        <input id="input_step_<?php echo $step->getId() ?>" type="hidden" name="step[]" value=<?php echo $val ?>>
            <?php 
                    }
                }   
            ?>
        </div>
        <?php //echo json_encode($val); ?>
        <input type="hidden" id="courseId" name="courseId" value="<?= $course ? $course->getId() : '' ?>">
        <button type="submit" class="btn btn-primary"><?php echo isset($course) ? "Modifier" : "Ajouter" ?></button>
    </form>
</section>

<?php include_once __DIR__ . '/../partials/addStepModal.php' ?>
<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
