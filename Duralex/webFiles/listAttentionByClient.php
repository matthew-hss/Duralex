<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();
$rut = $_POST['txtRut'];

$list = AttentionDao::getAttentionsByClient($rut);

if($rut==null || $list->count()<=0){
    $_SESSION['message'] = "El rut ingresado no tiene atenciones registradas.";
}

$_SESSION['attentions'] = $list;

header('Location: /Duralex/web/listAttention.php');
exit();



