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
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="container">
            <a href="#home">Home</a>
            <a href="#news">News</a>
            <div class="dropdown">
                <button class="dropbtn">Abogados</button>
                <div class="dropdown-content">
                    <a href="/Duralex/web/newLawyer.php">Agregar Abogado</a>
                    <a href="/Duralex/web/listLawyer.php">Listar Abogado</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Clientes</button>
                <div class="dropdown-content">
                    <a href="/Duralex/web/newClient.php">Agregar Cliente</a>
                    <a href="/Duralex/web/listClient.php">Listar Cliente</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Usuarios</button>
                <div class="dropdown-content">
                    <a href="/Duralex/web/newUser.php">Agregar Usuario</a>
                    <a href="/Duralex/web/listUser.php">Listar Usuario</a>
                </div>
            </div>
        </div>
    </body>
</html>
