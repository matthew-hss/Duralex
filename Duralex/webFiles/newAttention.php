<?php

include_once '../dto/AttentionDto.php';
include_once '../dao/AttentionDao.php';
//include_once '../dto/StatusDto.php';
//include_once '../dto/LawyerDto.php';
//include_once '../dto/ClientDto.php';

echo "<script type=\"text/javascript\"" . ">alert(\"".$_POST['txtDate']."\");</script>";
$dto = new AttentionDto();
$dto->getClient()->setId($_POST['ddlClient']);
$myDateTime = DateTime::createFromFormat('d-m-Y', $_POST['txtDate']);
$dto->setDate($myDateTime);
$dto->getLawyer()->setId($_POST['ddlLawyer']);
$dto->getStatus()->setId($_POST['ddlStatus']);
session_start();

if (AttentionDao::save($dto)) {
    echo "<script type=\"text/javascript\"" . ">alert(\"Registro exitoso.\");</script>";
    $_SESSION['message'] = "Registro exitoso.";
} else {
    echo "<script type=\"text/javascript\"" . ">alert(\"Error al agregar.\");</script>";
    $_SESSION['message'] = "Error al agregar.";
}

header('Location: /Duralex/web/newAttention.php');
exit();

