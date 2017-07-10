<?php

include_once '../dao/ClientDao.php';
session_start();

if (ClientDao::exist($_POST['txtRut'])) {
    if (ClientDao::deleteByRut($_POST['txtRut'])) {
        $_SESSION['message'] = "Registro eliminado correctamente.";
    } else {
        $_SESSION['message'] = "Error al eliminar registro.";
    }
}else{
    $_SESSION['message'] = "El rut ingresado no se encuentra en los registros.";
}

header('Location: /Duralex/web/deleteClient.php');
exit();



