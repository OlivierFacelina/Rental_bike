<?php

namespace App\models;
use PDO;
use Exception;

/**
 * Student
 */
class Bikes {
    private PDO $db;
    public function __construct(
        private int $student_id = 0, 
        private string $INE = '', 
        private string $firstname = '',
        private string $lastname = '',
        private string $birthdate = '',
        private string $phone = '',
        private string $email = '',
        private string $address = '',
        private string $postal_code = '',
        private string $city = '',
        private string $grade = '',
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

    public function all(string $search = ''): array
    {
        $parms = [];

        $sql = "SELECT 
                    `bike_id`, `registration_number`, `availability`, `photo`, `description` 
                FROM `bikes`";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute($parms)) {
            throw new Exception('La requête a échouée');
        }
        // FETCH_PROPS_LATE : pour le constructeur 
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\App\Models\Bikes');
        return $stmt->fetchAll();
    }

    /**
     * Récupère l'étudiant ayant l'id renseigné
     *
     * @param integer $student_id
     * @return object
     */
    public function find(int $bike_id)
    {
        $sql = "SELECT 
                    `bike_id`, `registration_number`, `availability`, 
                    `photo`, `description`
                FROM `bikes` WHERE `bike_id` = :bike_id";
        $stmt = $this->db->prepare($sql);
        // Lier le paramètre avec la valeur envoyée
        $stmt->bindValue(':bike_id', $bike_id, PDO::PARAM_INT);
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
        $sql = "INSERT INTO `bikes`(
                    `registration_number`, 
                    `availability`, 
                    `photo`,  
                    `description`)
                VALUES (
                    :registration_number, 
                    :availability, 
                    :photo,  
                    :description)"; 
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