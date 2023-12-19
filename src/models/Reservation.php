<?php

namespace App\models;
use PDO;
use Exception;

/**
 * Student
 */
class Reservation {
    private PDO $db;
    public function __construct(
        private int $user_id = 0, 
        private int $bike_id = 0, 
        private int $res_num = 0,
        private string $res_date = '',
        private string $start_date = '',
        private string $end_date = '',
        private string $status = '',
    ) {
        $this->db = Database::db_connect();
    }

    public function fullName(): string {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function __get($name) {
        if(property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function all(): array
    {

        $parms = [];

        $sql = "SELECT 
                    `user_id`, `bikes`.`bike_id`, DATE_FORMAT(`res_date`, '%Y-%m-%d %H:%i:%s') AS formatted_resdate, DATE_FORMAT(`start_date`, '%Y-%m-%d %H:%i:%s') AS formatted_startdate, DATE_FORMAT(`end_date`, '%Y-%m-%d %H:%i:%s') AS formatted_enddate, `registration_number`
                FROM `reservations`
                JOIN `bikes` ON `reservations`.`bike_id` = `bikes`.`bike_id`" ;
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute($parms)) {
            throw new Exception('La requête a échouée');
        }
        // FETCH_PROPS_LATE : pour le constructeur 
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\App\Models\Reservation');
        return $stmt->fetchAll();
    }

    /**
     * Récupère l'étudiant ayant l'id renseigné
     *
     * @param integer $student_id
     * @return object
     */
    public function find(int $student_id)
    {
        $sql = "SELECT 
                    `INE`, `firstname`, `lastname`, 
                    `birthdate`, DATE_FORMAT(`birthdate`, '%d/%m/%Y') AS formated_birthdate,  `phone`, `email`, `address`, `postal_code`, `city`, `grade` 
                FROM `students` WHERE `student_id` = :student_id";
        $stmt = $this->db->prepare($sql);
        // Lier le paramètre avec la valeur envoyée
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        // Exécuter la requête
        if (!$stmt->execute()) {
            throw new Exception('La requête a échouée');
        }

        return $stmt->fetch();
    }


    public function update(array $data)
    {
        $sql = "UPDATE `students` SET
                    `firstname` = :firstname, 
                    `lastname` = :lastname, 
                    `birthdate` = :birthdate,  
                    `phone` = :phone, 
                    `email` = :email, 
                    `address` = :address, 
                    `postal_code` = :postal_code, 
                    `city` = :city, 
                    `grade` = :grade 
                WHERE `student_id` = :student_id";
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête
        return $stmt->execute($data);
    }
    public function create(array $data)
    {
        $sql = "INSERT INTO `reservations`(
                    `bike_id`, 
                    `start_date`, 
                    `end_date`) 
                VALUES (
                    :bike_id, 
                    :start_date, 
                    :end_date)";
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête
        return $stmt->execute($data);
    }

    public function delete(int $student_id)
    {
        $sql = "DELETE FROM `students` WHERE `student_id` = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}