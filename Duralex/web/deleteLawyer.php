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
        if (isset($_SESSION['lawyer'])) {
            $lawyers = new ArrayObject();
            $lawyer = $_SESSION['lawyer'];
            unset($_SESSION['lawyer']);
            $lawyers->append($lawyer);
        } else {
            $lawyers = LawyerDao::getLawyers();
        }
        ?>
        <h3>DURALEX :: Eliminar Abogado</h3>
        <form action="/Duralex/webFiles/deleteLawyer.php" method="POST">
            <table border="0">                
                <tbody>
                    <tr>
                        <td>Rut Abogado</td>
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
