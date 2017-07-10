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
        echo "<script type=\"text/javascript\"" . ">alert(\"Registro exitoso.\");</script>";
        $_SESSION['message'] = "Registro exitoso.";
    } else {
        echo "<script type=\"text/javascript\"" . ">alert(\"Error al registrarse.\");</script>";
        $_SESSION['message'] = "Error al agregar.";
    }
} else {
    echo "<script type=\"text/javascript\"" . ">alert(\"Las contraseñas no coinciden.\");</script>";
    $_SESSION['message'] = "Las contraseñas no coinciden.";
}

header('Location: /Duralex/web/newUser.php');
