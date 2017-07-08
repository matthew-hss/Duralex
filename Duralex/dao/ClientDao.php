<?php

include_once '../dto/ClientDto.php';
include_once '../sql/ClasePDO.php';

class ClientDao {

    public static function save($dto) {
        try {
            $pdo = new clasePDO();
            $rut = $dto->getRut();
            $name = $dto->getName();
            $admission = $dto->getAdmissionDate()->format('Y-m-d');
            $personType = $dto->getPersonType();
            $address = $dto->getAddress();
            $phone = $dto->getPhone();

            $insert = $pdo->prepare("INSERT INTO client(rut, name, admission_date, person_type, address, phone) VALUES(?,?,?,?,?,?)");
            $insert->bindParam(1, $rut);
            $insert->bindParam(2, $name);
            $insert->bindParam(3, $admission);
            $insert->bindParam(4, $personType);
            $insert->bindParam(5, $address);
            $insert->bindParam(6, $phone);
            $insert->execute();

            if ($insert->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al guardar cliente: " . $ex->getMessage();
        }
        return false;
    }
    
    public static function getClients(){
        $clients = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("SELECT * FROM client");
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new ClientDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $dto->setAdmissionDate($x['admission_date']);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: ".$ex->getMessage();
        }
        return $clients;
    }
    
    public static function getClientsByPersonType($personType){
        $clients = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("SELECT * FROM client WHERE person_type = ?");
            $select->bindParam(1, $personType);
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new ClientDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $dto->setAdmissionDate($x['admission_date']);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: ".$ex->getMessage();
        }
        return $clients;
    }
    
    public static function getClientsBySeniority(){
        $clients = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("SELECT * FROM client ORDER BY date ASC ");            
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new ClientDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $dto->setAdmissionDate($x['admission_date']);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: ".$ex->getMessage();
        }
        return $clients;
    }

}
