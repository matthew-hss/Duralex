<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();
$id = $_POST['ddlLawyer'];

$list = AttentionDao::getAttentionsByLawyer($id);

if($id==null || $list->count()<=0){
    $_SESSION['message'] = "El abogado seleccionado no tiene atenciones registradas.";
}

$_SESSION['attentions'] = $list;

header('Location: /Duralex/web/listAttention.php');
exit();



