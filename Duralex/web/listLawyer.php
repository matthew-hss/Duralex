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
        include_once '../util/RutUtils.php';
        include_once '../dto/LawyerDto.php';
        include_once '../dao/LawyerDao.php';
        include_once '../dao/SpecialtyDao.php';
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
        if (isset($_SESSION['lawyer'])) {
            $lawyers = new ArrayObject();
            $lawyer = $_SESSION['lawyer'];
            unset($_SESSION['lawyer']);
            $lawyers->append($lawyer);
        } elseif(isset($_SESSION['lawyersBySpecialty'])){
            $lawyers = $_SESSION['lawyersBySpecialty'];
            unset($_SESSION['lawyersBySpecialty']);
        }else {
            $lawyers = LawyerDao::getLawyers();
        }
        ?>       
        <form action="/Duralex/webFiles/listLawyerByRut.php" method="POST">
            <h3>Listar abogados</h3>
            <input id="rut" type="text" name="txtRut" value="" required oninput="checkRut(this)" placeholder="RUT ABOGADO" class="filter"/>
            <input type="submit" value="FILTRAR" name="btnFilter" class="filter"/>     
        </form>
        <form action="/Duralex/webFiles/listLawyerBySpecialty.php" method="POST">            
            <select name="ddlSpecialty" required="true">
                <option value="" >Seleccione Especialidad</option>
                <?php foreach ($specialties as $x) { ?>
                    <option value="<?php echo $x->getId(); ?>"><?php echo $x->getName() ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="FILTRAR" name="btnFilter" class="filter" />     
        </form>
        <table border="0" class="width">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Fecha de contratación</th>
                    <th>Especialidad</th>
                    <th>Valor hora</th>                        
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lawyers as $x) { ?>
                    <tr>
                        <td><?php echo RutUtils::formatRut($x->getRut()); ?></td>
                        <td><?php echo $x->getName(); ?></td>
                        <td><?php echo $x->getHireDate()->format('d-m-Y'); ?></td>
                        <td><?php echo $x->getSpecialty()->getName(); ?></td>
                        <td><?php echo $x->getHourValue(); ?></td>                            
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
