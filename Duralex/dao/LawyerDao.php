<?php

include_once '../dto/LawyerDto.php';
include_once '../sql/ClasePDO.php';
include_once '../dao/SpecialtyDao.php';
include_once '../util/RutUtils.php';

class LawyerDao {
    
    public static function save($dto){
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($dto->getRut());
            $name = $dto->getName();
            $hireDate = $dto->getHireDate()->format('Y-m-d');
            $specialty = $dto->getSpecialty()->getId();
            $hourValue = $dto->getHourValue();
            
            $insert = $pdo->prepare("INSERT INTO lawyer(rut, name, hire_date, specialty_id, hour_value) VALUES(?,?,?,?,?)");
            $insert->bindParam(1, $rutNumber);
            $insert->bindParam(2, $name);
            $insert->bindParam(3, $hireDate);
            $insert->bindParam(4, $specialty);
            $insert->bindParam(5, $hourValue);
            $insert->execute();
            
            if($insert->rowCount()>0){
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al guardar abogado: ".$ex->getMessage();
        }
        return false;
    }
    
    public static function exist($rut){
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $select = $pdo->prepare("SELECT * FROM lawyer WHERE rut=?");
            $select->bindParam(1, $rutNumber);
            $select->execute();
            
            if($select->rowCount()>0){
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al verificar abogado: ".$ex->getMessage();
        }
        return false;
    }
    
    public static function getLawyerById($id){
        $dto = null;
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM lawyer WHERE id=?");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new LawyerDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['hire_date']);
                $dto->setHireDate($date);
                $dto->setSpecialty(SpecialtyDao::getSpecialtyById($x['specialty_id']));
                $dto->setHourValue($x['hour_value']);                
            }
        } catch (PDOException $ex) {            
            echo "Error SQL al obtener abogado: ".$ex->getMessage();
        }
        return $dto;
    }
    
    public static function getLawyerByRut($rut){
        $dto = null;
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $select = $pdo->prepare("SELECT * FROM lawyer WHERE rut=?");
            $select->bindParam(1, $rutNumber);
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new LawyerDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['hire_date']);
                $dto->setHireDate($date);
                $dto->setSpecialty(SpecialtyDao::getSpecialtyById($x['specialty_id']));
                $dto->setHourValue($x['hour_value']);                
            }
        } catch (PDOException $ex) {            
            echo "Error SQL al obtener abogado: ".$ex->getMessage();
        }
        return $dto;
    }
    
    public static function getLawyers(){
        $lawyers = new ArrayObject();
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM lawyer");
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new LawyerDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['hire_date']);
                $dto->setHireDate($date);
                $dto->setSpecialty(SpecialtyDao::getSpecialtyById($x['specialty_id']));
                $dto->setHourValue($x['hour_value']);
                $lawyers->append($dto);
            }
        } catch (PDOException $ex) {
            $lawyers = new ArrayObject();
            echo "Error SQL al obtener abogados: ".$ex->getMessage();
        }
        return $lawyers;
    }
    
    public static function getLawyersBySpecialty(){
        $lawyers = new ArrayObject();
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM lawyer");
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new LawyerDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['hire_date']);
                $dto->setHireDate($date);
                $dto->getSpecialty()->setId($x['specialty_id']);
                $dto->setHourValue($x['hour_value']);
                $lawyers->append($dto);
            }
        } catch (PDOException $ex) {
            $lawyers = new ArrayObject();
            echo "Error SQL al obtener abogados: ".$ex->getMessage();
        }
        return $lawyers;
    }
}
