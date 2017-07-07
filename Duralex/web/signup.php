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
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <form action="/Duralex/webfiles/signup.php" method="POST">
            <table border="0">
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
            <input type="submit" value="INGRESAR" name="btnLogin" />
        </form>
    </body>
</html>
