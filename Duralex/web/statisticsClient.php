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
        include_once '../dto/ClientDto.php';
        include_once '../util/RoleEnum.php';
        include_once '../util/RutUtils.php';
        include_once '../dao/ClientDao.php';
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
        if (isset($_SESSION['clients']) && isset($_SESSION['attentions'])) {
            $clients = $_SESSION['clients'];
            $attentions = $_SESSION['attentions'];
            $cantidad = $_SESSION['cantidad'];
            unset($_SESSION['cantidad']);
            unset($_SESSION['clients']);
            unset($_SESSION['attentions']);
        } else {
            $clients = ClientDao::getClients();
            $attentions = ClientDao::getClientsAttentionAmount();
        }
        ?>
        <form action="/Duralex/webFiles/statisticsClientByMonthAmount.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Meses de antiguedad</td>
                        <td><select name="ddlMonth">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>                                
                            </select></td>                       
                        <td><input type="submit" value="CONSULTAR" name="btnRequest" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <form action="/Duralex/webFiles/statisticsClientByPersonType.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Tipo de persona</td>
                        <td><select name="ddlPersonType">
                                <option value="J">Natural</option>
                                <option value="N">Jurídica</option>                                
                            </select></td>
                        <td><input type="submit" value="CONSULTAR" name="btnRequest" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <table border="0">
            <tbody>
                <tr>
                    <td>Cantidad</td>
                    <td><input type="text" name="txtTotal" value="<?php echo $cantidad ?>" disabled="true"/></td>
                </tr>
            </tbody>
        </table>
        <table border="0" class="width">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Fecha de admisión</th>
                    <th>Tipo de persona</th>                        
                    <th>Teléfono</th>
                    <th>N° de atenciones</th>
                </tr>
            </thead>
            <tbody>
                <?php   $aux=0;
                foreach ($clients as $x) { ?>
                    
                    <tr>
                        <td><?php echo RutUtils::formatRut($x->getRut()); ?></td>
                        <td><?php echo $x->getName(); ?></td>
                        <td><?php echo $x->getAdmissionDate()->format('d-m-Y'); ?></td>
                        <td>
                            <?php
                            if ($x->getPersonType() == "J") {
                                echo "Jurídica";
                            } elseif ($x->getPersonType() == "N") {
                                echo "Natural";
                            }
                            ?></td>                            
                        <td><?php echo $x->getPhone(); ?></td>
                        <td><?php echo $attentions[$aux]; $aux++; ?></td>
                    <?php } ?>

                </tr>

            </tbody>
        </table>
    </body>
</html>
