<?php

include_once '../dao/UserDao.php';
session_start();

if (UserDao::exist($_POST['txtRut'])) {
    if (UserDao::deleteByRut($_POST['txtRut'])) {
        $_SESSION['message'] = "Registro eliminado correctamente.";
    } else {
        $_SESSION['message'] = "Error al eliminar registro.";
    }
}else{
    $_SESSION['message'] = "El rut ingresado no se encuentra en los registros.";
}

header('Location: /Duralex/web/deleteUser.php');
exit();



