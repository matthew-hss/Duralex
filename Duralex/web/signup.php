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
        <script type="text/javascript">
            $(function () {
                $("#signup-rut").focusout(function () {
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
        <div>
            <h3>DURALEX :: Registro</h3>
            <form id="form-login" class="formulario1" action="/Duralex/webfiles/signup.php" method="POST">                                
                <table border="0" class="center">
                    <tbody>
                        <tr>
                            <td>RUT</td>
                            <td><input id="signup-rut" type="text" name="txtRut" value="" required oninput="checkRut(this)"/></td>
                        </tr>
                        <tr>
                            <td>Nombre</td>
                            <td><input type="text" name="txtName" value="" /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="txtPassword" value="" /></td>
                        </tr>
                        <tr>
                            <td>Confirmar Password</td>
                            <td><input type="password" name="txtPasswordConfirm" value="" /></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="buttonHolder">
                    <input type="submit" value="Registrarse" name="btnLogin" /><br>                
                </div>
                <div class="enlace" style="float: left;">
                    <a href="/Duralex/web/login.php"><div><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</div></a>
                </div>
            </form>
        </div>

        <footer>
            <div style="text-align: center;">
                Matthew Scheihing © Todos los derechos reservados.
            </div>
        </footer>
    </body>
</html>
