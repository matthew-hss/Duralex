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
        <form action="/Duralex/webfiles/signup.php" method="POST">
            <table border="0" class="center">
                <tbody>
                    <tr>
                        <td>RUT</td>
                        <td><input type="text" name="txtRut" value="" /></td>
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
            <div class="buttonHolder">
                <input type="submit" value="INGRESAR" name="btnLogin" />
            </div>
        </form>
    </body>
</html>
