<?php

include_once '../dto/LawyerDto.php';
include_once '../dao/LawyerDao.php';

session_start();

$lawyers = LawyerDao::getLawyersBySpecialty($_POST['ddlSpecialty']);
$_SESSION['lawyersBySpecialty'] = $lawyers;
if ($lawyers->count()<0) {
    $_SESSION['message'] = "No hay abogados con esa especialidad";
}

header('Location: /Duralex/web/listLawyer.php');
exit();
