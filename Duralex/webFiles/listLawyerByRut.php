<?php

include_once '../dto/LawyerDto.php';
include_once '../dao/LawyerDao.php';

session_start();

if (LawyerDao::exist($_POST['txtRut'])) {
    $dto = LawyerDao::getLawyerByRut($_POST['txtRut']);
    $_SESSION['lawyer'] = $dto;
    if ($dto == null) {
        $_SESSION['message'] = "Error al buscar registro";
    }
} else {
    $_SESSION['message'] = "El rut ingresado no se encuentra en los registros.";
}

header('Location: /Duralex/web/listLawyer.php');
exit();
