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
        } elseif ($user->getRole() == RoleEnum::Cliente) {
            header('Location: /Duralex/web/403.php');
        }
        include './layout.php';
        ?>
    </head>
    <body>
        <?php
        include_once '../dto/ClientDto.php';
        include_once '../dao/ClientDao.php';

        $clients = ClientDao::getClients();
        ?>
        <form action="/Duralex/webFiles/listClient.php" method="POST">
            <table border="0" class="width">
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Fecha de admisión</th>
                        <th>Tipo de persona</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $x) { ?>
                        <tr>
                            <td><?php echo $x->getRut(); ?></td>
                            <td><?php echo $x->getName(); ?></td>
                            <td><?php echo $x->getAdmissionDate(); ?></td>
                            <td>
                                <?php
                                if ($x->getPersonType() == "J") {
                                    echo "Jurídica";
                                } elseif ($x->getPersonType() == "N") {
                                    echo "Natural";
                                }
                                ?></td>
                            <td><?php echo $x->getAddress(); ?></td>
                            <td><?php echo $x->getPhone(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </form>
    </body>
</html>
