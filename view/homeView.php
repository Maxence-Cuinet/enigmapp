<!DOCTYPE html>
<html lang="fr">
<?php include_once('template/head.php') ?>
<body>
<?php include_once('template/nav.php') ?>

<section id="pageContent" class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
        <?php for ($i = 1; $i <= 7; $i++) { ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">Jeu de piste <?= $i ?></h5>
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Participer</a></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php include_once('template/footer.php') ?>
</body>
</html>
