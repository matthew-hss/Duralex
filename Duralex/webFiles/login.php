<?php

include_once '../dao/UserDao.php';
include_once '../dto/UserDto.php';

session_start();
$rut = $_POST['txtRut'];
$password = $_POST['txtPassword'];
$dto = UserDao::authenticate($rut, $password);

$_SESSION['user'] = $dto;

if($dto!=null){
    header('Location: /Duralex/web/index.php');    
    exit();
}else{    
    $_SESSION['message'] = "El rut y/o contraseña no son válidos.";    
    header('Location: /Duralex/web/login.php');
    exit();
}


