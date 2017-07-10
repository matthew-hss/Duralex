<?php

include_once '../dto/LawyerDto.php';
include_once '../dao/LawyerDao.php';

session_start();
$dto = new LawyerDto();
$dto->setHireDate(new DateTime());
$dto->setHourValue($_POST['txtHourValue']);
$dto->setName($_POST['txtName']);
$dto->setRut($_POST['txtRut']);
$specialty = new SpecialtyDto();
$specialty->setId($_POST['ddlSpecialty']);
$dto->setSpecialty($specialty);

if(LawyerDao::save($dto)){    
    $_SESSION['message'] = "Registro exitoso.";
}else{    
    $_SESSION['message'] = "Error al agregar.";
}

header('Location: /Duralex/web/newLawyer.php');
exit();


