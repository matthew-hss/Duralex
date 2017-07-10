<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';
include_once '../dto/UserDto.php';

session_start();
$status = $_POST['ddlStatus'];
$rut = $_SESSION['user']->getRut();

$list = AttentionDao::getAttentionsByClientAndStatus($rut, $status);

if($status==null || $rut==null || $list->count()<=0){
    $_SESSION['message'] = "No hay atenciones con el estado seleccionado.";
}

$_SESSION['attentions'] = $list;

header('Location: /Duralex/web/listClientAttention.php');
exit();



