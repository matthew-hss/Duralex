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
        include_once '../dao/SpecialtyDao.php';
        include_once '../dto/SpecialtyDto.php';
        include_once '../dto/LawyerDto.php';
        
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
        $specialties = SpecialtyDao::getSpecialties();
        ?>
        <h3>DURALEX :: Agregar Abogado</h3>
        <form action="/Duralex/webfiles/newLawyer.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>RUT</td>
                        <td><input id="rut" type="text" name="txtRut" value="" required="true" oninput="checkRut(this)"/></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" name="txtName" value="" required="true"/></td>
                    </tr>
                    <tr>
                        <td>Especialidad</td>
                        <td><select name="ddlSpecialty" required="true">
                                <option value="" >Seleccione Especialidad</option>
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
            <div class="buttonHolder">
                <input type="submit" value="AGREGAR" name="btnAdd" />
            </div>
        </form>
    </body>
</html>
