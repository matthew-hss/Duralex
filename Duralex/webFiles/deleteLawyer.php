<?php

include_once '../dao/LawyerDao.php';
session_start();

if (LawyerDao::exist($_POST['txtRut'])) {
    if (LawyerDao::deleteByRut($_POST['txtRut'])) {
        $_SESSION['message'] = "Registro eliminado correctamente.";
    } else {
        $_SESSION['message'] = "Error al eliminar registro.";
    }
}else{
    $_SESSION['message'] = "El rut ingresado no se encuentra en los registros.";
}

header('Location: /Duralex/web/deleteLawyer.php');
exit();



