<?php

class ClientDto {

    private $id;
    private $rut;
    private $name;
    private $admissionDate;
    private $personType;
    private $address;
    private $phone;

    function __construct() {
        $this->id = null;
        $this->rut = null;
        $this->name = null;
        $this->admissionDate = null;
        $this->personType = null;
        $this->address = null;
        $this->phone = null;
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

    function getAdmissionDate() {
        return $this->admissionDate;
    }

    function getPersonType() {
        return $this->personType;
    }

    function getAddress() {
        return $this->address;
    }

    function getPhone() {
        return $this->phone;
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

    function setAdmissionDate($admissionDate) {
        $this->admissionDate = $admissionDate;
    }

    function setPersonType($personType) {
        $this->personType = $personType;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

}
