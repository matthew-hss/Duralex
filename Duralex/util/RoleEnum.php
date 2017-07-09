<?php

abstract class RoleEnum {

    const Administrador = 0;
    const Cliente = 1;
    const Gerente = 2;
    const Secretaria = 3;

    static function getRole($enum) {
        switch ($enum) {
            case 0:
                echo "Administrador";
                break;
            case 1;
                echo "Cliente";
                break;
            case 2;
                echo "Gerente";
                break;
            case 3;
                echo "Secretaria";
                break;
        }
    }

}
