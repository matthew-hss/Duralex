<?php

include_once '../sql/ClasePDO.php';
include_once '../dto/UserDto.php';
include_once '../util/RutUtils.php';

class UserDao {

    public static function save($dto) {
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($dto->getRut());
            $name = $dto->getName();
            $password = md5($dto->getPassword());
            $role = $dto->getRole();

            $insert = $pdo->prepare("INSERT INTO user(rut,name,password,role) VALUES(?,?,?,?)");
            $insert->bindParam(1, $rutNumber);
            $insert->bindParam(2, $name);
            $insert->bindParam(3, $password);
            $insert->bindParam(4, $role);
            $insert->execute();

            if ($insert->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al intentar registrar usuario: " . $ex->getMessage();
        }
        return false;
    }
    
    public static function exist($rut){
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $select = $pdo->prepare("SELECT * FROM user WHERE rut=?");
            $select->bindParam(1, $rutNumber);
            $select->execute();
            
            if($select->rowCount()>0){
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al verificar usuario: ".$ex->getMessage();
        }
        return false;
    }

    public static function authenticate($rut, $password) {
        $dto = null;
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $pass = md5($password);

            $select = $pdo->prepare("SELECT * FROM user WHERE rut=? and password=?");
            $select->bindParam(1, $rutNumber);
            $select->bindParam(2, $pass);
            $select->execute();

            $fetch = $select->fetchAll();
            foreach ($fetch as $x) {
                $dto = new UserDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $dto->setPassword($x['password']);
                $dto->setRole($x['role']);
            }
        } catch (PDOException $ex) {
            echo "Error SQL al autenticar usuario: " . $ex->getMessage();
        }
        return $dto;
    }

    public static function getUserByRut($rut){
        $dto = null;
        try {
            $pdo = new ClasePdo();
            $rutNumber = RutUtils::getRutNumber($rut);
            $select = $pdo->prepare("SELECT * FROM user WHERE rut=?");
            $select->bindParam(1, $rutNumber);
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new UserDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $dto->setPassword($x['password']);
                $dto->setRole($x['role']);                
            }
        } catch (PDOException $ex) {            
            echo "Error SQL al obtener usuario: ".$ex->getMessage();
        }
        return $dto;
    }
    
    public static function getUsers(){
        $users = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("SELECT * FROM user");
            $select->execute();
            $fetch = $select->fetchAll();
            
            foreach ($fetch as $x) {
                $dto = new UserDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $dto->setPassword($x['password']);
                $dto->setRole($x['role']);
                $users->append($dto);
            }
        } catch (PDOException $ex) {
            $users = new ArrayObject();
            echo "Error SQL al obtener usuarios: ".$ex->getMessage();
        }
        return $users;
    }
    
    public static function deleteByRut($rut){
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $delete = $pdo->prepare("DELETE FROM user WHERE rut=?");
            $delete->bindParam(1, $rutNumber);
            $delete->execute();
            
            if($delete->rowCount()>0){
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al eliminar usuario: ".$ex->getMessage();
        }
        return false;
    }
}
