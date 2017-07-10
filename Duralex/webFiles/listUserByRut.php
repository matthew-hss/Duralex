<?php

include_once '../dto/UserDto.php';
include_once '../dao/UserDao.php';

session_start();

if (UserDao::exist($_POST['txtRut'])) {
    $dto = UserDao::getUserByRut($_POST['txtRut']);
    $_SESSION['user2'] = $dto;
    if ($dto == null) {
        $_SESSION['message'] = "Error al buscar registro";
    }
} else {
    $_SESSION['message'] = "El rut ingresado no se encuentra en los registros.";
}

header('Location: /Duralex/web/listUser.php');
exit();
