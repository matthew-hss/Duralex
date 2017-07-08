<?php

include_once '../dao/UserDao.php';
include_once '../dto/UserDto.php';

$rut = $_POST['txtRut'];
$password = $_POST['txtPassword'];
$dto = UserDao::authenticate($rut, $password);

session_start();
$_SESSION['user'] = $dto;

if($dto!=null){
    echo "<script type=\"text/javascript\"" . ">alert(\"Login exitoso.".$_SESSION['user']->getRole()."\");</script>";    
    header('Location: /Duralex/web/newLawyer.php');
}else{
    echo "<script type=\"text/javascript\"" . ">alert(\"El rut y/o contraseña no son válidos.\");</script>";
    $_SESSION['message'] = "El rut y/o contraseña no son válidos.";
    header('Location: /Duralex/web/login.php');
}


