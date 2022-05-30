<?php
include_once('Model/User.php');
?>

<html lang="fr">
<?php include_once('template/htmlHead.php') ?>
<body>

<div class="container">
    <form id="registerForm" action="/register/submit" method="post">
        <div class="mb-3">
            <label for="mail" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" required autofocus>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>

</body>
</html>
