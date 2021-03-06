<?php

include_once '../dto/ClientDto.php';
include_once '../sql/ClasePDO.php';
include_once '../util/RutUtils.php';

class ClientDao {

    public static function save($dto) {
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($dto->getRut());
            $name = $dto->getName();
            $admission = $dto->getAdmissionDate()->format('Y-m-d');
            $personType = $dto->getPersonType();
            $address = md5($dto->getAddress());
            $phone = $dto->getPhone();

            $insert = $pdo->prepare("INSERT INTO client(rut, name, admission_date, person_type, address, phone) VALUES(?,?,?,?,?,?)");
            $insert->bindParam(1, $rutNumber);
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

    public static function getClientById($id) {
        $dto = null;
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("SELECT * FROM client WHERE id=?");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new ClientDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['admission_date']);
                $dto->setAdmissionDate($date);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
            }
        } catch (PDOException $ex) {
            echo "Error SQL al obtener cliente: " . $ex->getMessage();
        }
        return $dto;
    }

    public static function getClientByRut($rut) {
        $dto = null;
        try {
            $pdo = new ClasePdo();
            $rutNumber = RutUtils::getRutNumber($rut);
            $select = $pdo->prepare("SELECT * FROM client WHERE rut=?");
            $select->bindParam(1, $rutNumber);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new ClientDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['admission_date']);
                $dto->setAdmissionDate($date);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
            }
        } catch (PDOException $ex) {
            echo "Error SQL al obtener cliente: " . $ex->getMessage();
        }
        return $dto;
    }

    public static function getClients() {
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
                $date = DateTime::createFromFormat('Y-m-d', $x['admission_date']);
                $dto->setAdmissionDate($date);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: " . $ex->getMessage();
        }
        return $clients;
    }

    public static function getClientsByPersonType($personType) {
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
                $date = DateTime::createFromFormat('Y-m-d', $x['admission_date']);
                $dto->setAdmissionDate($date);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: " . $ex->getMessage();
        }
        return $clients;
    }

    public static function getClientsBySeniority() {
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
                $date = DateTime::createFromFormat('Y-m-d', $x['admission_date']);
                $dto->setAdmissionDate($date);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: " . $ex->getMessage();
        }
        return $clients;
    }

    public static function getClientsByMonthAmount($months) {
        $clients = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("SELECT * FROM client WHERE ROUND(DATEDIFF(now(),admission_date)/30)=?");
            $select->bindParam(1, $months);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new ClientDto();
                $dto->setId($x['id']);
                $dto->setRut($x['rut']);
                $dto->setName($x['name']);
                $date = DateTime::createFromFormat('Y-m-d', $x['admission_date']);
                $dto->setAdmissionDate($date);
                $dto->setPersonType($x['person_type']);
                $dto->setAddress($x['address']);
                $dto->setPhone($x['phone']);
                $clients->append($dto);
            }
        } catch (PDOException $ex) {
            $clients = new ArrayObject();
            echo "Error SQL al obtener clientes: " . $ex->getMessage();
        }
        return $clients;
    }

    public static function exist($rut) {
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $select = $pdo->prepare("SELECT * FROM client WHERE rut=?");
            $select->bindParam(1, $rutNumber);
            $select->execute();

            if ($select->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al verificar cliente: " . $ex->getMessage();
        }
        return false;
    }

    public static function deleteByRut($rut) {
        try {
            $pdo = new clasePDO();
            $rutNumber = RutUtils::getRutNumber($rut);
            $delete = $pdo->prepare("DELETE FROM client WHERE rut=?");
            $delete->bindParam(1, $rutNumber);
            $delete->execute();

            if ($delete->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al eliminar cliente: " . $ex->getMessage();
        }
        return false;
    }

    public static function getClientsAttentionAmount() {
        $list = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("select count(attention.id) from client left join attention on client.id = attention.client_id group by client.id;");            
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $amount = $x['count(attention.id)'];
                $list->append($amount);
            }
        } catch (PDOException $ex) {
            $list = new ArrayObject();
            echo "Error SQL al obtener numero de atenciones: " . $ex->getMessage();
        }
        return $list;
    }
    public static function getClientsAttentionAmountByMonth($month) {
        $list = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("select count(attention.id) "
                    . "from client left join attention on client.id = attention.client_id "
                    . "WHERE ROUND(DATEDIFF(now(),client.admission_date)/30)=? group by client.id");
            $select->bindParam(1, $month);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $amount = $x['count(attention.id)'];
                $list->append($amount);
            }
        } catch (PDOException $ex) {
            $list = new ArrayObject();
            echo "Error SQL al obtener numero de atenciones: " . $ex->getMessage();
        }
        return $list;
    }
    public static function getClientsAttentionAmountByPersonType($personType) {
        $list = new ArrayObject();
        try {
            $pdo = new ClasePdo();
            $select = $pdo->prepare("select count(attention.id) "
                    . "from client left join attention on client.id = attention.client_id "
                    . "where client.person_type=? group by client.id;");
            $select->bindParam(1, $personType);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $amount = $x['count(attention.id)'];
                $list->append($amount);
            }
        } catch (PDOException $ex) {
            $list = new ArrayObject();
            echo "Error SQL al obtener numero de atenciones: " . $ex->getMessage();
        }
        return $list;
    }

}
