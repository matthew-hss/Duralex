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
        include './layout.php';
        include_once '../dto/UserDto.php';
        include_once '../util/RoleEnum.php';
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($user != null && $user->getRole() == RoleEnum::Cliente) {
                header('Location: /Duralex/web/403.php');
            }
        }
        ?>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            $msg = $_SESSION['message'];
            ?>
            <div class = "pop-outer">
                <div class = "pop-inner">
                    <button class = "close">X</button>
                    <p><?php echo $msg ?></p>
                </div>
            </div>
        <?php } ?>
        <?php
        include_once '../dao/SpecialtyDao.php';
        include_once '../dto/SpecialtyDto.php';
        include_once '../dto/LawyerDto.php';

        $specialties = SpecialtyDao::getSpecialties();
        ?>
        <form action="/Duralex/webfiles/newLawyer.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>RUT</td>
                        <td><input type="text" name="txtRut" value="" required="true"/></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" name="txtName" value="" required="true"/></td>
                    </tr>
                    <tr>
                        <td>Especialidad</td>
                        <td><select name="ddlSpecialty">
                                <?php foreach ($specialties as $x) { ?>
                                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getName() ?></option>
                                <?php } ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Valor hora</td>
                        <td><input type="text" name="txtHourValue" value="" required="true"/></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="AGREGAR" name="btnAdd" />
        </form>
    </body>
</html>
