<?php

class StatusDto {

    private $id;
    private $description;

    function __construct() {
        $this->id = null;
        $this->description = null;
    }

    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }

}
