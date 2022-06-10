<?php
$_SESSION['homeView'] = 'default';
?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once __DIR__ . '/../template/head.php' ?>
<body>
<script src="/js/home.js"></script>
<?php include_once __DIR__ . '/../template/nav.php' ?>

<section id="pageContent" class="container px-4 px-lg-5">
    <div class="d-flex my-4">
        <h3>Jeux de pistes</h3>
        <?php if (AuthController::isLogged(true)) { ?>
            <a type="button" class="btn btn-outline-dark ms-3" href="/course/create"><i class="fa-solid fa-plus me-2"></i><b>Ajouter</b></a>
            <div id="home-style-view">
                <a class="text-dark ms-3"><i class="fa-solid fa-grip fa-xl"></i></a>
                <a type="button" class="text-secondary ms-3" href="/home?admin"><i class="fa-solid fa-list fa-xl"></i></a>
            </div>
        <?php } ?>
    </div>
    <div class="d-flex justify-content-end mb-5">
        <form class="input-group search">
            <input type="text" class="form-control" id="search" value="<?= $_GET['q'] ?? null ?>"><label for="search"></label>
            <button type="submit" class="btn btn-outline-secondary" id="search-button">Recherche</button>
        </form>
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
                        <img class="card-img-top" src="<?= $course->getUrlImg() ? $course->getUrlImg() : "https://dummyimage.com/450x300/dee2e6/6c757d.jpg" ?>" alt="..." />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $course->getName() ?></h5>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col text-center">
                                        <a class="btn btn-outline-dark mt-auto" href="course/infos?courseId=<?= $course->getId() ?>">Participer</a>
                                    </div>
                                </div>
                                <?php if(AuthController::isLogged(true)) {?>
                                    <div class="row mt-4">
                                        <div class="col p-0 d-flex justify-content-end">
                                            <a href="/course/create?courseId=<?= $course->getId() ?>" class="me-3">
                                                <i class="fa-solid fa-edit text-primary fa-xl"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-name="<?= $course->getName() ?>" data-id="<?= $course->getId() ?>" class="delete-course">
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

        <?php include_once __DIR__ . '/../template/homePagination.php' ?>
    <?php } ?>
</section>
<?php include_once __DIR__ . '/../partials/homeViewModal.php' ?>
<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
