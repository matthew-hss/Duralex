<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RutUtils
 *
 * @author Matthew
 */
class RutUtils {

    static function formatRut($rut) {
        $fullRut = RutUtils::getDV($rut);
        return number_format(substr($fullRut, 0, - 1), 0, "", ".") . '-' . substr($fullRut, strlen($fullRut) - 1, 1);
    }

    static function getDV($rut) {
        /* remuevo los ceros del comienzo. */
        while ($rut[0] == "0") {
            $rut = substr($rut, 1);
        }
        $factor = 2;
        $suma = 0;
        for ($i = strlen($rut) - 1; $i >= 0; $i--) {
            $suma += $factor * $rut[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        return $rut.$dv;
    }

    static function getRutNumber($formattedRut) {
        $rut = str_replace(".", "", $formattedRut);
        $rut = str_replace("-", "", $rut);
        $rut = substr($rut, 0, -1);
        return $rut;
    }

}
