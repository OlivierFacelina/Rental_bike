<?php

namespace App\models;

use PDO;
use Exception;

class Reservation
{
    private PDO $db;
    public function __construct(
        private int $user_id = 0,
        private int $bike_id = 0,
        private string $res_num = '',
        private string $res_date = '',
        private string $start_date = '',
        private string $end_date = '',
        private string $status = ''
    ) {
        $this->db = Database::db_connect();
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function all(string $search = '')
    {

        $parms = [];
        $sql =
            <<<EOD
        SELECT 
            `users`.`firstname`,
            `users`.`lastname`,
            `bikes`.`registration_number`,
            `reservations`.`bike_id`,
            `reservations`.`res_num`,
            `reservations`.`res_date`, 
            `reservations`.`start_date`,
            `reservations`.`end_date`,
            `reservations`.`status`
        FROM 
            `reservations`
        JOIN
            `users`
        ON
            `reservations`.`user_id` = `users`.`user_id`
        JOIN
            `bikes`
        ON
            `reservations`.`bike_id` = `bikes`.`bike_id`
        EOD;
        if (!empty($search)) {
            $clause =
                <<<EOD
            WHERE 
                `users`.`firstname`
            LIKE
                :search
            OR 
                `users`.`lastname`
            LIKE
                :search
            OR 
                `bikes`.`registration_number`
            LIKE
                :search
            EOD;

            $sql .= $clause;

            $parms['search'] = $search . '%';
        }

        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute($parms)) {
            throw new Exception('La requête a échouée');
        }
        // FETCH_PROPS_LATE : pour le constructeur 
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\App\Models\Reservation');
        return $stmt->fetchAll();
    }



    public function update($status, $res_num)
    {
        $sql =
            <<<EOD
        UPDATE 
            `reservations` 
        SET
            `status` = :status
        WHERE 
            `res_num` = :res_num
        EOD;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':res_num', $res_num, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function create(array $data)
    {
        $sql = "INSERT INTO `reservations`(
                    `user_id`,
                    `bike_id`, 
                    `start_date`, 
                    `end_date`) 
                VALUES (
                    :user_id,
                    :bike_id, 
                    :start_date, 
                    :end_date)";
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête
        return $stmt->execute($data);
    }

    public function delete($res_num)
    {
        $sql = "DELETE FROM `reservations` WHERE `res_num` = :res_num";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':res_num', $res_num, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
