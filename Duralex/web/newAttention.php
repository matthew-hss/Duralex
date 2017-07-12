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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'}).val();
            });
        </script>
        <?php
        include_once '../dto/UserDto.php';
        include_once '../util/RoleEnum.php';
        include_once '../util/RutUtils.php';
        include_once '../dto/StatusDto.php';
        include_once '../dto/LawyerDto.php';
        include_once '../dto/ClientDto.php';
        include_once '../dao/StatusDao.php';
        include_once '../dao/LawyerDao.php';
        include_once '../dao/ClientDao.php';
        session_start();
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if ($user == null) {
            header('Location: /Duralex/web/login.php');
        } elseif ($user->getRole() != RoleEnum::Secretaria) {
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
        $statuses = StatusDao::getStatuses();
        $lawyers = LawyerDao::getLawyers();
        $clients = ClientDao::getClients();
        ?>
        <h3>DURALEX :: Agregar Atención</h3>
        <form action="/Duralex/webFiles/newAttention.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Abogado</td>
                        <td>
                            <select name="ddlLawyer" required="true">
                                <option value="" >Seleccione Abogado</option>
                                <?php foreach ($lawyers as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Cliente</td>
                        <td>
                            <select name="ddlClient" required="true">
                                <option value="" >Seleccione Cliente</option>
                                <?php foreach ($clients as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>"><?php echo RutUtils::formatRut($x->getRut()); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td><input id="datepicker" type="text" name="txtDate" value="" required="true"/></td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td>
                            <select name="ddlStatus" required="true">
                                <option value="" >Seleccione Estado</option>
                                <?php foreach ($statuses as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getDescription(); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="buttonHolder">
                <input type="submit" value="AGREGAR" name="btnAdd" />
            </div>
        </form>
    </body>
</html>
