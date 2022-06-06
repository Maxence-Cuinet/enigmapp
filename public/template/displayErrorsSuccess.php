<?php if (isset($_POST['errors']) && count($_POST['errors'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($_POST['errors'] as $error) {
            echo $error . '<br>';
        } ?>
    </div>
<?php } else if (isset($_POST['success']) && count($_POST['success'])) { ?>
    <div class="alert alert-succes" role="alert">
        <?php foreach ($_POST['success'] as $success) {
            echo $success . '<br>';
        } ?>
    </div>
<?php } ?>
