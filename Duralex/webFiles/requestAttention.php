<?php

include_once '../dao/StatusDao.php';
include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();

$dto = AttentionDao::getAttentionById($_POST['txtId']);
if ($dto != null) {
    $_SESSION['attention'] = $dto;    
} else {
    $_SESSION['message'] = "El número ingresado no está asociado a ninguna atención.";
}

header('Location: /Duralex/web/updateAttention.php');
exit();
