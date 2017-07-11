<?php

include_once '../dao/ClientDao.php';
include_once '../dto/ClientDto.php';

session_start();

$personType = $_POST['ddlPersonType'];
$cantidad = 0;

$attentions = ClientDao::getClientsAttentionAmountByPersonType($personType);
$clients = ClientDao::getClientsByPersonType($personType);
$_SESSION['clients'] = $clients;
$_SESSION['attentions'] = $attentions;

if ($clients->count() <= 0) {
    $_SESSION['message'] = "No hay clientes con ese tipo de persona.";
} else {
    foreach ($clients as $x) {
        $cantidad++;
    }
}

$_SESSION['cantidad'] = $cantidad;
header('Location: /Duralex/web/statisticsClient.php');
exit();

