<?php

include_once '../dto/UserDto.php';
include_once '../dao/UserDao.php';
include_once '../util/RoleEnum.php';

session_start();
$password = $_POST['txtPassword'];
$passwordConfirm = $_POST['txtPasswordConfirm'];

if ($password == $passwordConfirm) {
    $dto = new UserDto();
    $dto->setName($_POST['txtName']);
    $dto->setRut($_POST['txtRut']);
    $dto->setPassword($_POST['txtPassword']);
    if (isset($_POST['ddlRole'])) {
        $dto->setRole($_POST['ddlRole']);
    } else {
        $dto->setRole(RoleEnum::Cliente);
    }

    if (UserDao::save($dto)) {        
        $_SESSION['message'] = "Registro exitoso.";
        header('Location: /Duralex/web/login.php');
        exit();
    } else {        
        $_SESSION['message'] = "Error al registrarse.";
        header('Location: /Duralex/web/signup.php');
        exit();
    }
} else {    
    $_SESSION['message'] = "Las contraseñas no coinciden.";
    header('Location: /Duralex/web/signup.php');
    exit();
}


