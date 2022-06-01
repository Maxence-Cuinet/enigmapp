<?php
$isLogged = $_SESSION['is_logged'] ?? false;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">EnigmApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-lg-4">
            <?php if ($isLogged) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user me-2"></i><?= $_SESSION['user']['username'] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/account">Mon compte</a></li>
                        <li><a class="dropdown-item" href="/logout">Déconnexion</a></li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="nav-item"><a class="nav-link" href="/register">Inscription</a></li>
                <li class="nav-item"><a class="nav-link" href="/connection">Connexion</a></li>
            <?php } ?>
            </ul>
        </div>
    </div>
</nav>
