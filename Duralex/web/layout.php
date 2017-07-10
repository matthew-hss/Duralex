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
        <link rel="stylesheet" href="/Duralex/web/css/layout.css" type="text/css">        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function () {
                $(".open").click(function () {
                    $('.pop-outer').fadeIn('slow');
                });
                $(".close").click(function () {
                    $('.pop-outer').fadeOut('slow');
                });
            });
        </script>
        <?php
        include_once '../dto/UserDto.php';
        include_once '../util/RoleEnum.php';
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if ($user == null) {
            header('Location: /Duralex/web/login.php');
        }
        ?>
    </head>
    <body>
        <div class="container">
            <a href="/Duralex/web/index.php">Home</a>
            <?php if ($user->getRole() == RoleEnum::Gerente || $user->getRole() == RoleEnum::Secretaria || $user->getRole() == RoleEnum::Cliente) { ?>
                <div class="dropdown">
                    <button class="dropbtn">Atención</button>                
                    <div class="dropdown-content">
                        <?php if ($user->getRole() == RoleEnum::Secretaria) { ?>
                            <a href="/Duralex/web/newAttention.php">Agendar Atención</a>
                        <?php } ?>
                        <?php if ($user->getRole() == RoleEnum::Secretaria || $user->getRole() == RoleEnum::Gerente) { ?>
                            <a href="/Duralex/web/listAttention.php">Listar Atenciones</a>
                        <?php } ?>
                        <?php if ($user->getRole() == RoleEnum::Cliente) { ?>
                            <a href="/Duralex/web/listClientAttention.php">Mis Atenciones</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($user->getRole() == RoleEnum::Administrador || $user->getRole() == RoleEnum::Gerente || $user->getRole() == RoleEnum::Secretaria) { ?>
                <div class="dropdown">
                    <button class="dropbtn">Abogados</button>                
                    <div class="dropdown-content">
                        <?php if ($user->getRole() == RoleEnum::Administrador) { ?>
                            <a href="/Duralex/web/newLawyer.php">Agregar Abogado</a>
                        <?php } ?>
                        <a href="/Duralex/web/listLawyer.php">Listar Abogados</a>
                    </div>
                </div>
            <?php } ?>
            <?php if ($user->getRole() == RoleEnum::Administrador || $user->getRole() == RoleEnum::Gerente || $user->getRole() == RoleEnum::Secretaria) { ?>
                <div class="dropdown">
                    <button class="dropbtn">Clientes</button>
                    <div class="dropdown-content">
                        <?php if ($user->getRole() == RoleEnum::Administrador) { ?>
                            <a href="/Duralex/web/newClient.php">Agregar Cliente</a>
                        <?php } ?>
                        <a href="/Duralex/web/listClient.php">Listar Clientes</a>
                    </div>
                </div>
            <?php } ?>
            <?php if ($user->getRole() == RoleEnum::Administrador) { ?>
                <div class="dropdown">
                    <button class="dropbtn">Usuarios</button>
                    <div class="dropdown-content">
                        <a href="/Duralex/web/newUser.php">Agregar Usuario</a>
                        <a href="/Duralex/web/listUser.php">Listar Usuarios</a>
                    </div>
                </div>
            <?php } ?>
            <div class="dropdown" style="float: right">
                <button class="dropbtn">Hola, <?php echo $user->getName(); ?> !</button>
                <div class="dropdown-content">
                    <a href="/Duralex/web/login.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </body>
</html>
