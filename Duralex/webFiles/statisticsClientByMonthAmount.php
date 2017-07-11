<?php

include_once '../dao/ClientDao.php';
include_once '../dto/ClientDto.php';

session_start();

$month = $_POST['ddlMonth'];
$cantidad = 0;

$clients = ClientDao::getClientsByMonthAmount($month);
$attentions = ClientDao::getClientsAttentionAmountByMonth($month);
$_SESSION['clients'] = $clients;
$_SESSION['attentions'] = $attentions;

if ($clients->count() <= 0) {
    $_SESSION['message'] = "No hay clientes con esa cantidad de meses de antiguedad.";
} else {
    foreach ($clients as $x) {
        $cantidad++;
    }
}

$_SESSION['cantidad'] = $cantidad;
header('Location: /Duralex/web/statisticsClient.php');
exit();

