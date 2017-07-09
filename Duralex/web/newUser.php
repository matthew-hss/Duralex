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
                    <p><?php echo $msg ?></p>
                </div>
            </div>
        <?php } ?>
        <form action="/Duralex/webfiles/newUser.php" method="POST">
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
                    <tr>
                        <td>Rol</td>
                        <td><select name="ddlRole">
                                <option value="0">Administrador</option>
                                <option value="1">Cliente</option>
                                <option value="2">Gerente</option>                                
                                <option value="3">Secretaria</option>                                
                            </select></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="AGREGAR" name="btnAdd" />
        </form>
    </body>
</html>
