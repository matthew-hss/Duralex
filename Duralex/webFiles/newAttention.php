<?php

include_once '../dto/AttentionDto.php';
include_once '../dao/AttentionDao.php';
//include_once '../dto/StatusDto.php';
//include_once '../dto/LawyerDto.php';
//include_once '../dto/ClientDto.php';

session_start();
$dto = new AttentionDto();
$dto->getClient()->setId($_POST['ddlClient']);
$myDateTime = DateTime::createFromFormat('d-m-Y', $_POST['txtDate']);
$dto->setDate($myDateTime);
$dto->getLawyer()->setId($_POST['ddlLawyer']);
$dto->getStatus()->setId($_POST['ddlStatus']);


if (AttentionDao::save($dto)) {
    echo "<script type=\"text/javascript\"" . ">alert(\"Registro exitoso.\");</script>";
    $_SESSION['message'] = "Registro exitoso.";
} else {
    echo "<script type=\"text/javascript\"" . ">alert(\"Error al agregar.\");</script>";
    $_SESSION['message'] = "Error al agregar.";
}

header('Location: /Duralex/web/newAttention.php');
exit();

