<?php

include_once '../dto/AttentionDto.php';
include_once '../dao/ClientDao.php';
include_once '../dao/StatusDao.php';
include_once '../dao/LawyerDao.php';
include_once '../sql/ClasePDO.php';

class AttentionDao {

    public static function save($dto) {
        try {
            $pdo = new clasePDO();
            $date = $dto->getDate()->format('Y-m-d');
            $client = $dto->getClient()->getId();
            $lawyer = $dto->getLawyer()->getId();
            $status = $dto->getStatus()->getId();

            $insert = $pdo->prepare("INSERT INTO attention(date,client_id,lawyer_id,status_id) VALUES(?,?,?,?)");
            $insert->bindParam(1, $date);
            $insert->bindParam(2, $client);
            $insert->bindParam(3, $lawyer);
            $insert->bindParam(4, $status);
            $insert->execute();
            if ($insert->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error SQL al guardar atención: " . $ex->getMessage();
        }
        return false;
    }

    public static function getAttentions() {
        $attentions = new ArrayObject();
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention");
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsBySpecialty($id) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("select attention.id, attention.date, attention.client_id,attention.lawyer_id,attention.status_id "
                    . "from attention inner join lawyer on attention.lawyer_id = lawyer.id where lawyer.specialty_id = ? group by attention.id;");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsByLawyer($id) {
        $attentions = new ArrayObject();
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention WHERE lawyer_id=?");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsByStatus($id) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention WHERE status_id=?");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsByMonth($month) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention WHERE MONTH(date)=?");
            $select->bindParam(1, $month);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsBetweenDates($from, $to) {
        $attentions = new ArrayObject();
        $fromDate = $from->format('Y-m-d');
        $toDate = $to->format('Y-m-d');
        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention WHERE date between ? and ?");
            $select->bindParam(1, $fromDate);
            $select->bindParam(2, $toDate);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsByClient($rut) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("select attention.id, attention.date, attention.client_id,attention.lawyer_id,attention.status_id "
                    . "from attention inner join client on attention.client_id=client.id where client.rut=? group by attention.id;");
            $select->bindParam(1, $rut);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }
    
    public static function getAttentionsByClientAndLawyer($rut, $lawyer) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("select attention.id, attention.date, attention.client_id,attention.lawyer_id,attention.status_id "
                    . "from attention inner join client on attention.client_id=client.id inner join lawyer on attention.lawyer_id=lawyer.id "
                    . "where client.rut=? and lawyer.id=? group by attention.id;");
            $select->bindParam(1, $rut);
            $select->bindParam(2, $lawyer);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }
    
    public static function getAttentionsByClientAndStatus($rut, $status) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("select attention.id, attention.date, attention.client_id,attention.lawyer_id,attention.status_id "
                    . "from attention inner join client on attention.client_id=client.id inner join status on attention.status_id=status.id "
                    . "where client.rut=? and status.id=? group by attention.id;");
            $select->bindParam(1, $rut);
            $select->bindParam(2, $status);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $date = DateTime::createFromFormat('Y-m-d', $x['date']);
                $dto->setDate($date);
                $dto->setClient(ClientDao::getClientById($x['client_id']));
                $dto->setLawyer(LawyerDao::getLawyerById($x['lawyer_id']));
                $dto->setStatus(StatusDao::getStatusById($x['status_id']));
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

}
