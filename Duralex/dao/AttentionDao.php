<?php

include_once '../dto/AttentionDto.php';
include_once '../sql/ClasePDO.php';

class AttentionDao {

    public static function save($dto) {
        try {
            $pdo = new clasePDO();
            $date = $dto->getDate();
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
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
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
            $select = $pdo->prepare("select attention.id, attention.date, attention.client_id,attention.lawyer_id,attention.status_id "+
                    "from attention, lawyer where lawyer.specialty_id = ? group by attention.id;");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
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
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
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
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
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
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
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

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention WHERE date between ? and ?");
            $select->bindParam(1, $from);
            $select->bindParam(2, $to);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

    public static function getAttentionsByClient($id) {
        $attentions = new ArrayObject();

        try {
            $pdo = new clasePDO();
            $select = $pdo->prepare("SELECT * FROM attention WHERE client_id = ?");
            $select->bindParam(1, $id);
            $select->execute();
            $fetch = $select->fetchAll();

            foreach ($fetch as $x) {
                $dto = new AttentionDto();
                $dto->setId($x['id']);
                $dto->setDate($x['date']);
                $dto->getClient()->setId($x['client_id']);
                $dto->getLawyer()->setId($x['lawyer_id']);
                $dto->getStatus()->setId($x['status_id']);
                $attentions->append($dto);
            }
        } catch (PDOException $ex) {
            $attentions = new ArrayObject();
            echo "Error SQL al obtener atenciones: " . $ex->getMessage();
        }
        return $attentions;
    }

}
