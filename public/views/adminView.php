<?php
AuthController::redirectIfNotLogged(true);
$_SESSION['homeView'] = 'admin';
$search = $_GET['q'] ?? null;
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
        <a type="button" class="btn btn-outline-dark ms-3" href="/course/create"><i class="fa-solid fa-plus me-2"></i><b>Ajouter</b></a>
        <div id="home-style-view">
            <a type="button" class="text-secondary ms-3" href="/home?default"><i class="fa-solid fa-grip fa-xl"></i></a>
            <a class="text-dark ms-3"><i class="fa-solid fa-list fa-xl"></i></a>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-5">
        <form class="input-group search">
            <input type="text" class="form-control" id="search" value="<?= $search ?>"><label for="search"></label>
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
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" class="d-md-none"></th>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col" class="d-none d-lg-table-cell">Image</th>
                    <th scope="col" class="d-none d-md-table-cell">Description</th>
                    <th scope="col" class="d-none d-sm-table-cell">Date de création</th>
                    <th scope="col">Dernière modification</th>
                    <th scope="col" class="d-none d-md-table-cell"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $courses = $_POST['courses'];
                foreach ($courses as $course) { ?>
                    <tr data-href="course/infos?courseId=<?= $course->getId() ?>">
                        <td class="d-md-none">
                            <div class="d-flex">
                                <a href="/course/create?courseId=<?= $course->getId() ?>" class="me-3">
                                    <i class="fa-solid fa-edit text-primary fa-xl"></i></a>
                                <a href="javascript:void(0)" data-name="<?= $course->getName() ?>" data-id="<?= $course->getId() ?>" class="delete-course">
                                    <i class="fa fa-trash text-danger fa-xl"></i></a>
                            </div>
                        </td>
                        <th class="view-description" scope="row"><?= $course->getId() ?></th>
                        <td class="view-description text-truncate" style="max-width: 100px;"><?= $course->getName() ?></td>
                        <td class="view-description text-truncate d-none d-lg-table-cell" style="max-width: 250px;"
                            data-bs-toggle="popover" data-bs-placement="bottom"
                            data-bs-content="<img class='img-fluid' src='<?= $course->getUrlImg() ?>'>"
                            data-bs-html="true" data-bs-trigger="hover">
                            <?= $course->getUrlImg() ?>
                        </td>
                        <td class="view-description text-truncate d-none d-md-table-cell" style="max-width: 200px;"><?= $course->getDescription()  ?></td>
                        <td class="view-description d-none d-sm-table-cell"><?= $course->getCreatedAt()->format('d/m/Y') ?></td>
                        <td class="view-description text-center"><?= $course->getUpdatedAt()->format('d/m/Y - H:i') ?></td>
                        <td class="d-none d-md-table-cell">
                            <div class="d-flex">
                                <a href="/course/create?courseId=<?= $course->getId() ?>" class="me-3">
                                    <i class="fa-solid fa-edit text-primary fa-xl"></i></a>
                                <a href="javascript:void(0)" data-name="<?= $course->getName() ?>" data-id="<?= $course->getId() ?>" class="delete-course">
                                    <i class="fa fa-trash text-danger fa-xl"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?php include_once __DIR__ . '/../template/homePagination.php' ?>
    <?php } ?>
</section>
<?php include_once __DIR__ . '/../partials/homeViewModal.php' ?>
<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
