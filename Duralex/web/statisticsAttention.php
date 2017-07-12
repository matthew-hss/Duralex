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
                $("#from").datepicker({dateFormat: 'dd-mm-yy'}).val();
                $("#to").datepicker({dateFormat: 'dd-mm-yy'}).val();
            });
        </script>
        <?php
        include_once '../dto/UserDto.php';
        include_once '../util/RoleEnum.php';
        include_once '../util/RutUtils.php';
        include_once '../dto/LawyerDto.php';
        include_once '../dao/AttentionDao.php';
        include_once '../dao/SpecialtyDao.php';
        include_once '../dao/LawyerDao.php';
        include_once '../dao/StatusDao.php';
        session_start();
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if ($user == null) {
            header('Location: /Duralex/web/login.php');
        } elseif ($user->getRole() != RoleEnum::Gerente) {
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
        $cantidad = 0;
        $valorizacion = 0;
        $specialties = SpecialtyDao::getSpecialties();
        $lawyers = LawyerDao::getLawyers();
        $statuses = StatusDao::getStatuses();
        if (isset($_SESSION['attentions'])) {
            $attentions = $_SESSION['attentions'];
            $cantidad = $_SESSION['cantidad'];
            $valorizacion = $_SESSION['valorizacion'];
            unset($_SESSION['attentions']);
            unset($_SESSION['cantidad']);
            unset($_SESSION['valorizacion']);
        } else {
            $attentions = AttentionDao::getAttentions();
        }
        ?>
        <h3>DURALEX :: Estadísticas de Atenciones</h3>
        <form action="/Duralex/webFiles/statisticsAttentionByDates.php" method="POST">
            <input id="from" type="text" name="txtFrom" value="" required="true" placeholder="Desde"/>
            <input id="to" type="text" name="txtTo" value="" required="true" placeholder="Hasta"/>
            <input type="submit" value="CONSULTAR" name="btnRequest" class="filter"/>
        </form>
        <form action="/Duralex/webFiles/statisticsAttentionByMonth.php" method="POST">
            <select name="ddlMonth" required="true">
                <option value="">Seleccione un mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <input type="submit" value="CONSULTAR" name="btnRequest" class="filter"/>            
        </form>
        <form action="/Duralex/webFiles/statisticsAttentionBySpecialty.php" method="POST">
            <select name="ddlSpecialty" required="true">
                <option value="">Seleccione Especialidad</option>
                <?php foreach ($specialties as $x) { ?>
                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getName(); ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="CONSULTAR" name="btnRequest" class="filter"/>
        </form>
        <form action="/Duralex/webFiles/statisticsAttentionByLawyer.php" method="POST">
            <select name="ddlLawyer" required="true">
                <option value="">Seleccione Abogado</option>
                <?php foreach ($lawyers as $x) { ?>
                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getName(); ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="CONSULTAR" name="btnRequest" class="filter"/>            
        </form>
        <form action="/Duralex/webFiles/statisticsAttentionByStatus.php" method="POST">
            <select name="ddlStatus" required="true">
                <option value="">Seleccione Estado</option>
                <?php foreach ($statuses as $x) { ?>
                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getDescription(); ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="CONSULTAR" name="btnRequest" class="filter"/>            
        </form>
        <table border="0">
            <tbody>
                <tr>
                    <td>Cantidad</td>
                    <td><input type="text" name="txtTotal" value="<?php echo $cantidad ?>" disabled="true"/></td>
                    <td>Valorización</td>
                    <td><input type="text" name="txtValor" value="<?php echo $valorizacion ?>" disabled="true"/></td>
                </tr>
            </tbody>
        </table>
        <table border="0" class="width">
            <thead>
                <tr>
                    <th>Rut Cliente</th>
                    <th>Cliente</th>
                    <th>Abogado</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attentions as $x) { ?>
                    <tr>
                        <td><?php echo RutUtils::formatRut($x->getClient()->getRut()); ?></td>
                        <td><?php echo $x->getClient()->getName(); ?></td>
                        <td><?php echo $x->getLawyer()->getName(); ?></td>
                        <td><?php echo $x->getDate()->format('d-m-Y'); ?></td>
                        <td><?php echo $x->getStatus()->getDescription(); ?></td>                            
                    </tr>
                <?php } ?>
            </tbody>
        </table>        
    </body>
</html>
