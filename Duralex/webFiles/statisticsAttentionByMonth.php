<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();

$month = $_POST['ddlMonth'];
$cantidad = 0;
$valorizacion = 0;

$attentions = AttentionDao::getAttentionsByMonth($month);
$_SESSION['attentions'] = $attentions;

if ($attentions->count() <= 0) {
    $_SESSION['message'] = "No hay atenciones en el mes seleccionado.";
} else {
    foreach ($attentions as $x) {
        $cantidad++;
        $dto = LawyerDao::getLawyerById($x->getLawyer()->getId());
        $valorizacion += $dto->getHourValue();
    }
}

$_SESSION['cantidad'] = $cantidad;
$_SESSION['valorizacion'] = $valorizacion;
header('Location: /Duralex/web/statisticsAttention.php');
exit();

