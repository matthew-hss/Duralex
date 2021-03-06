<?php

include_once '../dto/SpecialtyDto.php';
include_once '../sql/ClasePDO.php';

class SpecialtyDao {

    public static function getSpecialties() {
        $specialties = new ArrayObject();
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM specialty");
            $select->execute();

            $fetch = $select->fetchAll();
            foreach ($fetch as $x) {
                $dto = new SpecialtyDto();
                $dto->setId($x['id']);
                $dto->setName($x['name']);
                $specialties->append($dto);
            }
        } catch (PDOException $ex) {
            $specialties = new ArrayObject();
            echo "Error SQL al obtener especialidades: " . $ex->getMessage();
        }
        return $specialties;
    }
    
    public static function getSpecialtyById($id) {
        $dto = null;
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM specialty WHERE id=?");
            $select->bindParam(1, $id);
            $select->execute();

            $fetch = $select->fetchAll();
            foreach ($fetch as $x) {
                $dto = new SpecialtyDto();
                $dto->setId($x['id']);
                $dto->setName($x['name']);                
            }
        } catch (PDOException $ex) {            
            echo "Error SQL al obtener especialidad: " . $ex->getMessage();
        }
        return $dto;
    }

}
