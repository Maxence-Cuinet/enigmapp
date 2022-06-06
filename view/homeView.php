<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<script src="/view/js/home.js"></script>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container px-4 px-lg-5 mt-5">
        <div class="d-flex mb-4">
            <h3>Jeux de pistes</h3>
            <?php if (AuthController::isLogged(true)) { ?>
                <a type="button" class="btn btn-outline-dark ms-3" href="/add-course"><i class="fa-solid fa-plus me-2"></i><b>Ajouter</b></a>
            <?php } ?>
        </div>
        <?php if (empty($_POST['courses'])) {?>
            <div class="row mt-5">
                <div class="col text-center">
                    <h1>Aucun jeu de piste enregistré. <i class="fa fa-face-sad-cry text-warning"></i></h1>
                </div>
            </div>
        <?php } else { ?>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
                <?php 
                $courses = $_POST['courses'];
                foreach ($courses as $course) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?php echo $course->getUrlImg() ? $course->getUrlImg() : "https://dummyimage.com/450x300/dee2e6/6c757d.jpg" ?>" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo $course->getName() ?></h5>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="#">Participer</a>
                                        </div>
                                    </div>
                                    <?php if(AuthController::isLogged(true)) {?>
                                        <div class="row mt-4">
                                            <div class="col p-0 d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="me-2">
                                                    <i class="fa fa-edit text-primary fa-xl"></i>
                                                </a>
                                                &nbsp;
                                                <a href="javascript:void(0)" data-name="<?php echo $course->getName() ?>" data-id="<?php echo $course->getId() ?>" class="delete-course">
                                                    <i class="fa fa-trash text-danger fa-xl"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row mt-4">
                <div class="col d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= $_POST['page'] == 1 ? 'disabled' : ''?>">
                                <a class="page-link" href="<?= $_POST['page'] == 1 ? 'javascript:void(0)' : "/home?page=" . ($_POST['page'] - 1) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php if (in_array($_POST['page'], [1, 2])) { ?>
                                <li class="page-item <?= $_POST['page'] == 1 ? 'active' : ''?>"><a class="page-link" href="/home?page=1">1</a></li>
                                <li class="page-item <?= $_POST['page'] == 2 ? 'active' : ''?> <?= $_POST['max'] < 2 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=2">2</a></li>
                                <li class="page-item <?= $_POST['max'] < 3 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=3">3</a></li>
                                <li class="page-item <?= $_POST['max'] < 4 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=4">4</a></li>
                                <li class="page-item <?= $_POST['max'] < 5 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=5">5</a></li>
                            <?php } else if (in_array($_POST['page'], [$_POST['max'], $_POST['max'] - 1])) { ?>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 4) ?>"><?= $_POST['max'] - 4 ?></a></li>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 3) ?>"><?= $_POST['max'] - 3 ?></a></li>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 2) ?>"><?= $_POST['max'] - 2 ?></a></li>
                                <li class="page-item <?= $_POST['page'] == $_POST['max'] - 1 ? 'active' : ''?>"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 1) ?>"><?= $_POST['max'] - 1 ?></a></li>
                                <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'active' : ''?>"><a class="page-link" href="<?= "/home?page=" . $_POST['max'] ?>"><?= $_POST['max'] ?></a></li>
                            <?php } else { ?>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] - 2) ?>"><?= $_POST['page'] - 2 ?></a></li>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] - 1) ?>"><?= $_POST['page'] - 1 ?></a></li>
                                <li class="page-item active"><a class="page-link" href="<?= "/home?page=" . ($_POST['page']) ?>"><?= $_POST['page'] ?></a></li>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] + 1) ?>"><?= $_POST['page'] + 1 ?></a></li>
                                <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] + 2) ?>"><?= $_POST['page'] + 2 ?></a></li>
                            <?php } ?>
                            <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'disabled' : ''?>">
                                <a class="page-link" href="<?= $_POST['page'] == $_POST['max'] ? 'javascript:void(0)' : "/home?page=" . ($_POST['page'] + 1) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } ?>
</section>
<?php include_once('partials/homeViewModal.php') ?>
<?php include_once('template/footer.php') ?>
</body>
</html>
