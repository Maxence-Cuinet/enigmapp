<?php
$search = $_GET['q'] ?? null;
?>
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
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 4) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['max'] - 4 ?></a></li>
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 3) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['max'] - 3 ?></a></li>
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 2) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['max'] - 2 ?></a></li>
                    <li class="page-item <?= $_POST['page'] == $_POST['max'] - 1 ? 'active' : ''?>"><a class="page-link" href="<?= "/home?page=" . ($_POST['max'] - 1) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['max'] - 1 ?></a></li>
                    <li class="page-item <?= $_POST['page'] == $_POST['max'] ? 'active' : ''?>"><a class="page-link" href="<?= "/home?page=" . $_POST['max'] . ($search ? "&q={$search}" : '') ?>"><?= $_POST['max'] ?></a></li>
                <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] - 2) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['page'] - 2 ?></a></li>
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] - 1) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['page'] - 1 ?></a></li>
                    <li class="page-item active"><a class="page-link" href="<?= "/home?page=" . ($_POST['page']) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['page'] ?></a></li>
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] + 1) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['page'] + 1 ?></a></li>
                    <li class="page-item"><a class="page-link" href="<?= "/home?page=" . ($_POST['page'] + 2) . ($search ? "&q={$search}" : '') ?>"><?= $_POST['page'] + 2 ?></a></li>
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
