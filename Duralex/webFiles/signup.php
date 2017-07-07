<?php

include_once '../dto/UserDto.php';
include_once '../dao/UserDao.php';
include_once '../util/RoleEnum.php';

$password = $_POST['txtPassword'];
$passwordConfirm = $_POST['txtPasswordConfirm'];
if ($password == $passwordConfirm) {
    $dto = new UserDto();
    $dto->setName($_POST['txtName']);
    $dto->setRut($_POST['txtRut']);
    $dto->setPassword($_POST['txtPassword']);
    $dto->setRole(RoleEnum::Cliente);
    
    if(UserDao::signUp($dto)){
        echo "<script type=\"text/javascript\"" . ">alert(\"Registro exitoso.\");</script>";
        include_once './pages/login.php';
    }else{
        echo "<script type=\"text/javascript\"" . ">alert(\"Error al registrarse.\");</script>";
        include_once './pages/signup.php';
    }
}else{
    echo "<script type=\"text/javascript\"" . ">alert(\"Las contraseñas no coinciden.\");</script>";
    include_once './pages/signup.php';
}


