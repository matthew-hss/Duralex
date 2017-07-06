<?php

include_once '../dto/LawyerDto.php';
include_once '../sql/ClasePDO.php';

class LawyerDao {
    
    public static function save($dto){
        try {
            $pdo = new clasePDO();
            $rut = $dto->getRut();
            $name = $dto->getName();
            $hireDate = $dto->getHireDate();
            $specialty = $dto->getSpecialty()->getId();
            $hourValue = $dto->getHourValue();
            
            $insert = $pdo->prepare("INSERT INTO lawyer(rut, name, hire_date, specialty_id, hour_value) VALUES(?,?,?,?,?)");
            $insert->bindParam(1, $rut);
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
                $dto->setHireDate($x['hire_date']);
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
                $dto->setHireDate($x['hire_date']);
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