<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>        
        <?php
        include_once '../dto/UserDto.php';
        include_once '../util/RoleEnum.php';
        session_start();
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if ($user == null) {
            header('Location: /Duralex/web/login.php');
        } elseif ($user->getRole() != RoleEnum::Administrador) {
            header('Location: /Duralex/web/403.php');
        }
        include './layout.php';
        ?>
    </head>
    <body>
        <?php
        include_once '../dto/UserDto.php';
        include_once '../dao/UserDao.php';
        include_once '../util/RoleEnum.php';

        $users = UserDao::getUsers();
        ?>
        <form action="/Duralex/webFiles/listUser.php" method="POST">
            <table border="0" class="width">
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $x) { ?>
                        <tr>
                            <td><?php echo $x->getRut(); ?></td>
                            <td><?php echo $x->getName(); ?></td>
                            <td><?php RoleEnum::getRole($x->getRole()); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </form>
    </body>
</html>
