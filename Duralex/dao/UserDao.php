<?php

include_once '../sql/ClasePDO.php';
include_once '../dto/UserDto.php';

class UserDao {

    public static function signUp($dto) {
        try {
            $pdo = new clasePDO();
            $rut = $dto->getRut();
            $name = $dto->getName();
            $password = md5($dto->getPassword());
            $role = $dto->getRole();

            $insert = $pdo->prepare("INSERT INTO user(rut,name,password,role) VALUES(?,?,?,?)");
            $insert->bindParam(1, $rut);
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

    public static function authenticate($rut, $password) {
        $dto = null;
        try {
            $pdo = new clasePDO();
            $pass = md5($password);

            $select = $pdo->prepare("SELECT * FROM user WHERE rut=? and password=?");
            $select->bindParam(1, $rut);
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

}
