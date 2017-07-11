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
        include_once '../dto/AttentionDto.php';
        include_once '../dto/LawyerDto.php';
        include_once '../dto/StatusDto.php';
        include_once '../dao/AttentionDao.php';
        include_once '../dao/LawyerDao.php';
        include_once '../dao/StatusDao.php';
        include_once '../util/RutUtils.php';
        session_start();
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if ($user == null) {
            header('Location: /Duralex/web/login.php');
        } elseif ($user->getRole() == RoleEnum::Cliente || $user->getRole() == RoleEnum::Administrador) {
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
        $lawyers = LawyerDao::getLawyers();
        $statuses = StatusDao::getStatuses();
        if (isset($_SESSION['attentions'])) {
            $attentions = $_SESSION['attentions'];
            unset($_SESSION['attentions']);
        } else {
            $attentions = AttentionDao::getAttentions();
        }
        ?>
        <form action="/Duralex/webFiles/listAttentionByClient.php" method="POST">
            <table border="0">                
                <tbody>
                    <tr>
                        <td>Rut Cliente</td>
                        <td><input id="rut" type="text" name="txtRut" value="" required oninput="checkRut(this)"/></td>
                        <td><input type="submit" value="FILTRAR" name="btnFilter" /></td>
                    </tr>
                </tbody>
            </table>            
        </form>
        <form action="/Duralex/webFiles/listAttentionByLawyer.php" method="POST">
            <table border="0">                
                <tbody>
                    <tr>
                        <td>Abogado</td>
                        <td><select name="ddlLawyer">
                                <?php foreach ($lawyers as $x) { ?>                                        
                                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getName(); ?></option>
                                <?php } ?>
                            </select></td>
                        <td><input type="submit" value="FILTRAR" name="btnFilter" /></td>
                    </tr>
                </tbody>
            </table>            
        </form>
        <form action="/Duralex/webFiles/listAttentionByStatus.php" method="POST">
            <table border="0">                
                <tbody>
                    <tr>
                        <td>Estado</td>
                        <td><select name="ddlStatus">
                                <?php foreach ($statuses as $x) { ?>                                        
                                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getDescription(); ?></option>
                                <?php } ?>
                            </select></td>
                        <td><input type="submit" value="FILTRAR" name="btnFilter" /></td>
                    </tr>
                </tbody>
            </table>            
        </form>
        <table border="0" class="width">
            <thead>
                <tr>
                    <th>ID</th>
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
                        <td><?php echo $x->getId(); ?></td>
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
