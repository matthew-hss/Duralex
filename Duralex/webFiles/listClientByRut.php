<?php

include_once '../dto/ClientDto.php';
include_once '../dao/ClientDao.php';

session_start();

if (ClientDao::exist($_POST['txtRut'])) {
    $dto = ClientDao::getClientByRut($_POST['txtRut']);
    $_SESSION['client'] = $dto;
    if ($dto == null) {
        $_SESSION['message'] = "Error al buscar registro";
    }
} else {
    $_SESSION['message'] = "El rut ingresado no se encuentra en los registros.";
}

header('Location: /Duralex/web/listClient.php');
exit();
