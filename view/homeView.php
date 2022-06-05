<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container px-4 px-lg-5 mt-5">
    <div class="d-flex mb-4">
        <h3>Jeux de pistes</h3>
        <?php if (AuthController::isLogged(true)) { ?>
            <a type="button" class="btn btn-outline-dark ms-3" href="/add-course"><i class="fa-solid fa-plus me-2"></i><b>Ajouter</b></a>
        <?php } ?>
    </div>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
        <?php 
        $courses = $_POST['courses'];
        foreach($courses as $course) {
        ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="<?php echo $course->getUrlImg() ? $course->getUrlImg() : "https://dummyimage.com/450x300/dee2e6/6c757d.jpg" ?>" alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder"><?php echo $course->getId().'. '.$course->getName() ?></h5>
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="course-infos">Participer</a></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="<?php echo $_POST['page'] == 1 ? 'javascript:void(0)' : "/home?page=".($_POST['page']-1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>

                    <?php if (in_array($_POST['page'], [1, 2])) { ?>
                        <li class="page-item <?php echo $_POST['page'] == 1 ? 'active' : ''?>"><a class="page-link" href="/home?page=1">1</a></li>
                        <li class="page-item <?php echo $_POST['page'] == 2 ? 'active' : ''?>"><a class="page-link" href="/home?page=2">2</a></li>
                        <li class="page-item"><a class="page-link" href="/home?page=3">3</a></li>
                        <li class="page-item"><a class="page-link" href="/home?page=4">4</a></li>
                        <li class="page-item"><a class="page-link" href="/home?page=5">5</a></li>
                    <?php } else if (in_array($_POST['page'], [$_POST['max'], $_POST['max']-1])) { ?>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['max']-4) ?>"><?php echo $_POST['max']-4 ?></a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['max']-3) ?>"><?php echo $_POST['max']-3 ?></a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['max']-2) ?>"><?php echo $_POST['max']-2 ?></a></li>
                        <li class="page-item <?php echo $_POST['page'] == $_POST['max']-1 ? 'active' : ''?>"><a class="page-link" href="<?php echo "/home?page=".($_POST['max']-1) ?>"><?php echo $_POST['max']-1 ?></a></li>
                        <li class="page-item <?php echo $_POST['page'] == $_POST['max'] ? 'active' : ''?>"><a class="page-link" href="<?php echo "/home?page=".$_POST['max'] ?>"><?php echo $_POST['max'] ?></a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['page']-2) ?>"><?php echo $_POST['page']-2 ?></a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['page']-1) ?>"><?php echo $_POST['page']-1 ?></a></li>
                        <li class="page-item active"><a class="page-link" href="<?php echo "/home?page=".($_POST['page']) ?>"><?php echo $_POST['page'] ?></a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['page']+1) ?>"><?php echo $_POST['page']+1 ?></a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "/home?page=".($_POST['page']+2) ?>"><?php echo $_POST['page']+2 ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                    <a class="page-link" href="<?php echo $_POST['page'] == $_POST['max'] ? 'javascript:void(0)' : "/home?page=".($_POST['page']+1) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
