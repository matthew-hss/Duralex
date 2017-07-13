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
        include_once '../dto/StatusDto.php';
        include_once '../dto/LawyerDto.php';
        include_once '../dto/ClientDto.php';
        include_once '../dto/AttentionDto.php';
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
        if (isset($_SESSION['attention'])) {
            $attention = $_SESSION['attention'];
            $_SESSION['attentionId'] = $attention->getId();
            unset($_SESSION['attention']);
        }
        ?>
        <h3>DURALEX :: Actualizar Atención</h3>
        <form action="/Duralex/webFiles/requestAttention.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>ID de Atención</td>
                        <td><input type="text" name="txtId" value="" required="true"/></td>
                        <td><input type="submit" value="CONSULTAR" name="btnRequest" /></td>
                    </tr>
                </tbody>
            </table>            
        </form>
        <form action="/Duralex/webFiles/updateAttention.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td><input type="text" name="txtId" value="<?php
                            if (isset($attention)) {
                                echo $attention->getId();
                            }
                            ?>" disabled="true" /></td>
                    </tr>
                    <tr>
                        <td>Abogado</td>
                        <td>
                            <select name="ddlLawyer" disabled="true" >
                                <?php foreach ($lawyers as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>" <?php
                                    if (isset($attention)) {
                                        if ($x->getId() == $attention->getLawyer()->getId()) {
                                            ?>
                                                    selected="selected"
                                                    <?php
                                                }
                                            }
                                            ?>><?php echo $x->getName(); ?></option>
                                        <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Cliente</td>
                        <td>
                            <select name="ddlClient" disabled="true">
                                <?php foreach ($clients as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>" <?php
                                    if (isset($attention)) {
                                        if ($x->getId() == $attention->getClient()->getId()) {
                                            ?>
                                                    selected="selected"
                                                    <?php
                                                }
                                            }
                                            ?>><?php echo $x->getName(); ?></option>
                                        <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td><input id="datepicker" type="text" name="txtDate" value="<?php
                            if (isset($attention)) {
                                echo $attention->getDate()->format('d-m-Y');
                            }
                            ?>" required="true" disabled="true"/></td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td>
                            <select name="ddlStatus">
                                <?php foreach ($statuses as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>" <?php
                                    if (isset($attention)) {
                                        if ($x->getId() == $attention->getStatus()->getId()) {
                                            ?>
                                                    selected="selected"
                                                    <?php
                                                }
                                            }
                                            ?>><?php echo $x->getDescription(); ?></option>
                                        <?php } ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="buttonHolder">
                <input type="submit" value="ACTUALIZAR" name="btnUpdate" />
            </div>
        </form>
    </body>
</html>
