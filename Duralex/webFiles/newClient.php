<?php

include_once '../dto/ClientDto.php';
include_once '../dao/ClientDao.php';
include_once '../util/RoleEnum.php';

$user = $_SESSION['user'];
if($user->getRole()== RoleEnum::Cliente){        
    header('Location: /Duralex/web/pages/403.php');
}

