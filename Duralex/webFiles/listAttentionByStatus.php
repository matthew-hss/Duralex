<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();
$status = $_POST['ddlStatus'];

$list = AttentionDao::getAttentionsByStatus($status);

if($status==null || $list->count()<=0){
    $_SESSION['message'] = "No hay atenciones con el estado seleccionado.";
}

$_SESSION['attentions'] = $list;

header('Location: /Duralex/web/listAttention.php');
exit();



