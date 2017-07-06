<?php

class SpecialtyDto {

    private $id;
    private $name;

    function __construct() {
        $this->id = null;
        $this->name = null;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

}
