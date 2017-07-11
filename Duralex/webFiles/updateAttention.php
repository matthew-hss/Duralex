<?php

include_once '../dao/StatusDao.php';
include_once '../dto/StatusDto.php';
include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();

$dto = AttentionDao::getAttentionById($_SESSION['attentionId']);
if ($dto != null) {
    unset($_SESSION['attentionId']);
    $status = StatusDao::getStatusById($_POST['ddlStatus']);
    $dto->setStatus($status);
    if (AttentionDao::update($dto)) {
        $_SESSION['message'] = "Atención actualizada correctamente.";
    } else {
        $_SESSION['message'] = "Error al actualizar atención.";
    }
} else {
    $_SESSION['message'] = "El número ingresado no está asociado a ninguna atención.";
}

header('Location: /Duralex/web/updateAttention.php');
exit();



