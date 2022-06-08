<?php
AuthController::redirectIfNotLogged(true);
$_SESSION['homeView'] = 'admin';
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
            <a type="button" class="text-dark ms-3" href="/home?default"><i class="fa-solid fa-grip fa-xl"></i></a>
            <a class="text-secondary ms-3"><i class="fa-solid fa-list fa-xl"></i></a>
        </div>
    </div>
    <?php if (empty($_POST['courses'])) {?>
        <div class="row mt-5">
            <div class="col text-center">
                <h1>Aucun jeu de piste enregistré. <i class="fa fa-face-sad-cry text-warning"></i></h1>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Date de création</th>
                <th scope="col">Dernière modification</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $courses = $_POST['courses'];
            foreach ($courses as $course) {
                $description = substr($course->getDescription(), 0, 50);
                $description = strlen($description) !== strlen($course->getDescription()) ? $description . '...' : $description;
            ?>
                <tr>
                    <th scope="row"><?= $course->getId() ?></th>
                    <td><?= $course->getName() ?></td>
                    <td><?= $description  ?></td>
                    <td><?= $course->getCreatedAt()->format('d/m/Y') ?></td>
                    <td><?= $course->getUpdatedAt()->format('d/m/Y - H:i') ?></td>
                    <td>
                        <a href="/course/create?courseId=<?= $course->getId() ?>" class="me-3">
                            <i class="fa-solid fa-edit text-primary fa-xl"></i>
                        </a>
                        <a href="javascript:void(0)" data-name="<?= $course->getName() ?>" data-id="<?= $course->getId() ?>" class="delete-course">
                            <i class="fa fa-trash text-danger fa-xl"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="row mt-4">
            <div class="col d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $_POST['page'] == 1 ? 'disabled' : ''?>">
                            <a class="page-link" href="<?= $_POST['page'] == 1 ? 'javascript:void(0)' : "/home?admin&page=" . ($_POST['page'] - 1) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php if (in_array($_POST['page'], [1, 2])) { ?>
                            <li class="page-item <?= $_POST['page'] == 1 ? 'active' : ''?>"><a class="page-link" href="/home?admin&page=1">1</a></li>
                            <li class="page-item <?= $_POST['page'] == 2 ? 'active' : ''?> <?= $_POST['max'] < 2 ? 'disabled' : ''?>"><a class="page-link" href="/home?admin&page=2">2</a></li>
                            <li class="page-item <?= $_POST['max'] < 3 ? 'disabled' : ''?>"><a class="page-link" href="/home?admin&page=3">3</a></li>
                            <li class="page-item <?= $_POST['max'] < 4 ? 'disabled' : ''?>"><a class="page-link" href="/home?admin&page=4">4</a></li>
                            <li class="page-item <?= $_POST['max'] < 5 ? 'disabled' : ''?>"><a class="page-link" href="/home?admin&page=5">5</a></li>
                        <?php } else if (in_array($_POST['page'], [$_POST['max'], $_POST['max'] - 1])) { ?>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['max'] - 4) ?>"><?= $_POST['max'] - 4 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['max'] - 3) ?>"><?= $_POST['max'] - 3 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['max'] - 2) ?>"><?= $_POST['max'] - 2 ?></a></li>
                            <li class="page-item <?= $_POST['page'] == $_POST['max'] - 1 ? 'active' : ''?>"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['max'] - 1) ?>"><?= $_POST['max'] - 1 ?></a></li>
                            <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'active' : ''?>"><a class="page-link" href="<?= "/home?admin&page=" . $_POST['max'] ?>"><?= $_POST['max'] ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['page'] - 2) ?>"><?= $_POST['page'] - 2 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['page'] - 1) ?>"><?= $_POST['page'] - 1 ?></a></li>
                            <li class="page-item active"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['page']) ?>"><?= $_POST['page'] ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['page'] + 1) ?>"><?= $_POST['page'] + 1 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?admin&page=" . ($_POST['page'] + 2) ?>"><?= $_POST['page'] + 2 ?></a></li>
                        <?php } ?>
                        <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'disabled' : ''?>">
                            <a class="page-link" href="<?= $_POST['page'] == $_POST['max'] ? 'javascript:void(0)' : "/home?admin&page=" . ($_POST['page'] + 1) ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } ?>
</section>
<?php include_once __DIR__ . '/../partials/homeViewModal.php' ?>
<?php include_once __DIR__ . '/../template/footer.php' ?>
</body>
</html>
