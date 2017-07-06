<?php

class UserDto {

    private $id;
    private $rut;
    private $name;
    private $password;
    private $role;

    function __construct() {
        $this->id = null;
        $this->rut = null;
        $this->name = null;
        $this->password = null;
        $this->role = null;
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

    function getPassword() {
        return $this->password;
    }

    function getRole() {
        return $this->role;
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

    function setPassword($password) {
        $this->password = $password;
    }

    function setRole($role) {
        $this->role = $role;
    }

}
