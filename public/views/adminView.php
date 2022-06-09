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
                        <th scope="row"><?= $course->getId() ?></th>
                        <td class="text-truncate" style="max-width: 100px;"><?= $course->getName() ?></td>
                        <td class="text-truncate d-none d-lg-table-cell" style="max-width: 250px;"
                            data-bs-toggle="popover" data-bs-placement="bottom"
                            data-bs-content="<img class='img-fluid' src='<?= $course->getUrlImg() ?>'>"
                            data-bs-html="true" data-bs-trigger="hover">
                            <?= $course->getUrlImg() ?>
                        </td>
                        <td class="text-truncate d-none d-md-table-cell" style="max-width: 200px;"><?= $course->getDescription()  ?></td>
                        <td class="d-none d-sm-table-cell"><?= $course->getCreatedAt()->format('d/m/Y') ?></td>
                        <td class="text-center"><?= $course->getUpdatedAt()->format('d/m/Y - H:i') ?></td>
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

        <div class="row mt-4">
            <div class="col d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $_POST['page'] == 1 ? 'disabled' : ''?>">
                            <a class="page-link" href="<?= $_POST['page'] == 1 ? 'javascript:void(0)' : ("/home?page=" . ($_POST['page'] - 1) . ($search ? "&q={$search}" : '')) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php if (in_array($_POST['page'], [1, 2])) { ?>
                            <li class="page-item <?= $_POST['page'] == 1 ? 'active' : ''?>"><a class="page-link" href="/home?page=1<?= $search ? "&q={$search}" : '' ?>">1</a></li>
                            <li class="page-item <?= $_POST['page'] == 2 ? 'active' : ''?> <?= $_POST['max'] < 2 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=2<?= $search ? "&q={$search}" : '' ?>">2</a></li>
                            <li class="page-item <?= $_POST['max'] < 3 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=3<?= $search ? "&q={$search}" : '' ?>">3</a></li>
                            <li class="page-item <?= $_POST['max'] < 4 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=4<?= $search ? "&q={$search}" : '' ?>">4</a></li>
                            <li class="page-item <?= $_POST['max'] < 5 ? 'disabled' : ''?>"><a class="page-link" href="/home?page=5<?= $search ? "&q={$search}" : '' ?>">5</a></li>
                        <?php } else if (in_array($_POST['page'], [$_POST['max'], $_POST['max'] - 1])) { ?>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 4) . $search ? "&q={$search}" : '' ?>"><?= $_POST['max'] - 4 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 3) . $search ? "&q={$search}" : '' ?>"><?= $_POST['max'] - 3 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 2) . $search ? "&q={$search}" : '' ?>"><?= $_POST['max'] - 2 ?></a></li>
                            <li class="page-item <?= $_POST['page'] == $_POST['max'] - 1 ? 'active' : ''?>"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 1) . $search ? "&q={$search}" : '' ?>"><?= $_POST['max'] - 1 ?></a></li>
                            <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'active' : ''?>"><a class="page-link" href="<?= "/home?page=" . $_POST['max'] . $search ? "&q={$search}" : '' ?>"><?= $_POST['max'] ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] - 2) . $search ? "&q={$search}" : '' ?>"><?= $_POST['page'] - 2 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] - 1) . $search ? "&q={$search}" : '' ?>"><?= $_POST['page'] - 1 ?></a></li>
                            <li class="page-item active"><a class="page-link" href="<?= "/home?page=" . ($_POST['page']) . $search ? "&q={$search}" : '' ?>"><?= $_POST['page'] ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] + 1) . $search ? "&q={$search}" : '' ?>"><?= $_POST['page'] + 1 ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] + 2) . $search ? "&q={$search}" : '' ?>"><?= $_POST['page'] + 2 ?></a></li>
                        <?php } ?>
                        <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'disabled' : ''?>">
                            <a class="page-link" href="<?= $_POST['page'] == $_POST['max'] ? 'javascript:void(0)' : ("/home?page=" . ($_POST['page'] + 1) . ($search ? "&q={$search}" : '')) ?>" aria-label="Next">
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
