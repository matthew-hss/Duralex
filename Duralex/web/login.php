<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
unset($_SESSION['user']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/Duralex/web/css/layout.css" type="text/css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/Duralex/web/js/rutValidator.js"></script>
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
        <form action="/Duralex/webfiles/login.php" method="POST">
            <table border="0" class="center">
                <tbody>
                    <tr>
                        <td>RUT</td>
                        <td><input id="login-rut" type="text" name="txtRut" value="" required oninput="checkRut(this)" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="txtPassword" value="" required /></td>
                    </tr>
                </tbody>
            </table>
            <div class="buttonHolder">
                <input type="submit" value="INGRESAR" name="btnLogin" /><br>
                <a href="/Duralex/web/signup.php">Registrarse</a>
            </div>
        </form>
    </body>
</html>