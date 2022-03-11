<?php
include_once('Model/User.php');
include_once('Controller/UserController.php');

if (isset($_GET['action'])) {
    UserController::action($_GET);
}

?>

<table>
    <thead>
        <tr>
            <th colspan="5">Liste des utilisateurs</th>
        </tr>
        <tr>
            <th>Id</th>
            <th>Login</th>
            <th>Mail</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $users = User::findAll();
    foreach ($users as $user) {
        ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getLogin() ?></td>
            <td><?= $user->getMail() ?></td>
            <td><?= $user->getPassword() ?></td>
            <td>
                <a href=".?action=delete&id=<?= $user->getId() ?>">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
