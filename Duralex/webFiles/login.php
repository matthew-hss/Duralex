<?php

include_once '../dao/UserDao.php';
include_once '../dto/UserDto.php';

session_start();
$rut = $_POST['txtRut'];
$password = $_POST['txtPassword'];
$dto = UserDao::authenticate($rut, $password);

$_SESSION['user'] = $dto;

if($dto!=null){
    echo "<script type=\"text/javascript\"" . ">alert(\"Login exitoso.\");</script>";    
//    include_once '../web/newLawyer.php';
    header('Location: /Duralex/web/index.php');    
    exit();
}else{
    echo "<script type=\"text/javascript\"" . ">alert(\"El rut y/o contraseña no son válidos.\");</script>";
//    $_SESSION['message'] = "El rut y/o contraseña no son válidos.";
    $_SESSION['message'] = $rutFormateado." ---- ".$rut;
    header('Location: /Duralex/web/login.php');
    exit();
}


