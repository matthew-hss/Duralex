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
        include_once '../dao/UserDao.php';
        include_once '../util/RoleEnum.php';
        include_once '../util/RutUtils.php';

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
        if (isset($_SESSION['message'])) {
            $msg = $_SESSION['message'];
            ?>
            <div class = "pop-outer">
                <div class = "pop-inner">
                    <button class = "close">X</button>
                    <p><?php echo $msg; ?></p>
                </div>
            </div>
            <?php
            unset($_SESSION['message']);
        }
        ?>
        <?php
        if (isset($_SESSION['user2'])) {
            $users = new ArrayObject();
            $user2 = $_SESSION['user2'];
            unset($_SESSION['user2']);
            $users->append($user2);
        } else {
            $users = UserDao::getUsers();
        }
        ?>
        <h3>DURALEX :: Eliminar Usuario</h3>
        <form action="/Duralex/webFiles/deleteUser.php" method="POST">
            <table border="0">                
                <tbody>
                    <tr>
                        <td>Rut Usuario</td>
                        <td><input id="rut" type="text" name="txtRut" value="" required oninput="checkRut(this)"/></td>
                        <td><input type="submit" value="ELIMINAR" name="btnDelete" /></td>
                    </tr>
                </tbody>
            </table>            
        </form>
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
                        <td><?php echo RutUtils::formatRut($x->getRut()); ?></td>
                        <td><?php echo $x->getName(); ?></td>
                        <td><?php RoleEnum::getRole($x->getRole()); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
