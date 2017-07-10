<?php

include_once '../dao/AttentionDao.php';
include_once '../dto/AttentionDto.php';

session_start();

$from = DateTime::createFromFormat('d-m-Y', $_POST['txtFrom']);
$to = DateTime::createFromFormat('d-m-Y', $_POST['txtTo']);
$cantidad = 0;
$valorizacion = 0;

if ($from <= $to) {
    $attentions = AttentionDao::getAttentionsBetweenDates($from, $to);
    $_SESSION['attentions'] = $attentions;
    if ($attentions->count() <= 0) {
        $_SESSION['message'] = "No hay atenciones entre las fechas seleccionadas.";
    } else {
        foreach ($attentions as $x) {
            $cantidad++;
            $dto = LawyerDao::getLawyerById($x->getLawyer()->getId());
            $valorizacion += $dto->getHourValue();
        }
    }
} else {
    $_SESSION['message'] = "La fecha 'Desde' no puede ser mayor a 'Hasta'.";
}

$_SESSION['cantidad'] = $cantidad;
$_SESSION['valorizacion'] = $valorizacion;
header('Location: /Duralex/web/statisticsAttention.php');
exit();

