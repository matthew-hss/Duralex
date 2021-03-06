<?php

include_once '../sql/ClasePDO.php';
include_once '../dto/StatusDto.php';

class StatusDao {
    
    public static function getStatusById($id){
        $dto = null;
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM status WHERE id=?");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();
            foreach ($fetch as $x) {
                $dto = new StatusDto();
                $dto->setId($x['id']);
                $dto->setDescription($x['description']);                
            }
        } catch (PDOException $ex) {            
            echo "Error SQL al obtener estados: ".$ex->getMessage();
        }
        return $dto;
    }
    
    public static function getStatuses(){
        $statuses = new ArrayObject();
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM status");
            $select->execute();
            $fetch = $select->fetchAll();
            foreach ($fetch as $x) {
                $dto = new StatusDto();
                $dto->setId($x['id']);
                $dto->setDescription($x['description']);
                $statuses->append($dto);                
            }
        } catch (PDOException $ex) {
            $statuses = new ArrayObject();
            echo "Error SQL al obtener estados: ".$ex->getMessage();
        }
        return $statuses;
    }
}
