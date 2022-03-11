<?php
include_once('Model/User.php');
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
                <a href="/users/delete/<?= $user->getId() ?>">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
