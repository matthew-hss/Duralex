<?php

class LawyerDto {

    private $id;
    private $rut;
    private $name;
    private $hireDate;
    private $specialty;
    private $hourValue;

    function __construct() {
        $this->id = null;
        $this->rut = null;
        $this->name = null;
        $this->hireDate = null;
        $this->specialty = new SpecialtyDto();
        $this->hourValue = null;
    }

    function getId() {
        return $this->id;
    }

    function getRut() {
        return $this->rut;
    }

    function getName() {
        return $this->name;
    }

    function getHireDate() {
        return $this->hireDate;
    }

    function getSpecialty() {
        return $this->specialty;
    }

    function getHourValue() {
        return $this->hourValue;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setHireDate($hireDate) {
        $this->hireDate = $hireDate;
    }

    function setSpecialty($specialty) {
        $this->specialty = $specialty;
    }

    function setHourValue($hourValue) {
        $this->hourValue = $hourValue;
    }

}
