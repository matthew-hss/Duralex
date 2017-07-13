<?php

include_once '../dto/ClientDto.php';
include_once '../dao/ClientDao.php';
include_once '../util/RoleEnum.php';

session_start();
$dto = new ClientDto();
$dto->setAddress($_POST['txtAddress']);
$dto->setAdmissionDate(new DateTime());
$dto->setName($_POST['txtName']);
$dto->setPersonType($_POST['ddlPersonType']);
$dto->setPhone($_POST['txtPhone']);
$dto->setRut($_POST['txtRut']);

if (!ClientDao::exist($dto->getRut())) {
    if (ClientDao::save($dto)) {
        $_SESSION['message'] = "Registro exitoso.";
    } else {
        $_SESSION['message'] = "Error al agregar.";
    }
}else{
    $_SESSION['message'] = "El rut ya se encuentra registrado.";
}

header('Location: /Duralex/web/newClient.php');
exit();

