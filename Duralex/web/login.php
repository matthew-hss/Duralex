<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
session_destroy();
//unset($_SESSION['user']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/Duralex/web/css/layout.css" type="text/css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/Duralex/web/js/rutValidator.js"></script>        
        <link rel="stylesheet" href="/Duralex/web/css/bootstrap.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
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

        <div class="col-sm-6 col-md-5 form-container">
            <h3>INICIAR SESIÓN</h3>
            <div class="img-login"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
            <form id="form-login" class="formulario1" action="/Duralex/webFiles/login.php" method="POST">
                <div class="buttonHolder">
                    <input id="login-rut" type="text" name="txtRut" value="" placeholder="RUT" required oninput="checkRut(this)"/><br><br>
                    <input id="login-pass" type="password" name="txtPassword" value="" placeholder="Contraseña" /><br><br>
                    <input type="submit" value="Ingresar" name="btnLogin" />
                </div>
                <?php
                if (isset($_SESSION['message'])) {
                    $msg = $_SESSION['message'];
                    ?>
                    <div class="msgbox">
                        <?php echo $msg ?>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>
            </form>
            <div style="margin:10px 0;">
                <div class="enlace">
                    <a href="/Duralex/web/signup.php"><div><i class="fa fa-user-plus" aria-hidden="true"></i> Regístrate</div></a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $("#login-rut").focusout(function () {
                    var rut = $(this).val();
                    rut = rut.toUpperCase();
                    rut = rut.replace(".", "");
                    rut = rut.replace("-", "");
                    rut = rut.substring(0, rut.length - 7) + "." + rut.substring(rut.length - 7, rut.length - 4) + "."
                            + "" + rut.substring(rut.length - 4, rut.length - 1) + "-" + rut.charAt(rut.length - 1);
                    $(this).val(rut);
                });
            });
        </script>

        <footer>
            <div style="text-align: center;">
                Matthew Scheihing © Todos los derechos reservados.
            </div>
        </footer>
    </body>
</html>