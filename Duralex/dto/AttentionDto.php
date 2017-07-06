<?php

include_once './ClientDto.php';
include_once './LawyerDto.php';
include_once './StatusDto.php';

class AttentionDto {
    private $id;
    private $date;
    private $client;
    private $lawyer;
    private $status;
    
    function __construct() {
        $this->id = null;
        $this->date = null;
        $this->client = new ClientDto();
        $this->lawyer = new LawyerDto();
        $this->status = new StatusDto();
    }
    
    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getClient() {
        return $this->client;
    }

    function getLawyer() {
        return $this->lawyer;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setClient($client) {
        $this->client = $client;
    }

    function setLawyer($lawyer) {
        $this->lawyer = $lawyer;
    }

    function setStatus($status) {
        $this->status = $status;
    }



}
