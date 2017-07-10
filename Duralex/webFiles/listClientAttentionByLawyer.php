<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';
include_once '../dto/UserDto.php';

session_start();
$id = $_POST['ddlLawyer'];
$rut = $_SESSION['user']->getRut();

$list = AttentionDao::getAttentionsByClientAndLawyer($rut, $id);

if($id==null || $rut==null || $list->count()<=0){
    $_SESSION['message'] = "El abogado seleccionado no tiene atenciones registradas.";
}

$_SESSION['attentions'] = $list;

header('Location: /Duralex/web/listClientAttention.php');
exit();


