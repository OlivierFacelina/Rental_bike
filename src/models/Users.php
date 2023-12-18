<?php

namespace App\models;
use PDO;
use Exception;

/**
 * Student
 */
class Users {
    private PDO $db;
    public function __construct(
        private int $suser_id = 0, 
        private string $firstname = '',
        private string $lastname = '',
        private string $login = '', 
        private string $password = '',
        private string $role_id = '',
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
    public function update_password(){

    }

    public function all(string $search = ''): array
    {

        $parms = [];

        $sql = "SELECT 
                    `student_id`, `INE`, `firstname`, `lastname`, 
                    `birthdate`, `phone`, `email`, `address`, `postal_code`, `city`, `grade` 
                FROM `students`";
        if (!empty($search)) {
            $clause = ' WHERE `firstname` LIKE :search OR lastname LIKE :search';

            $sql .= $clause;

            $parms['search'] = $search . '%';
        }

        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute($parms)) {
            throw new Exception('La requête a échouée');
        }
        // FETCH_PROPS_LATE : pour le constructeur 
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\App\Models\Users');
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
        $sql = <<<EOD
            INSERT INTO 
            `users`(
                `firstname`, 
                `lastname`, 
                `login`,  
                `password`, 
                `role_id`) 
            VALUES (
                :firstname, 
                :lastname, 
                :login,  
                :password, 
                :role_id)
        EOD;
        $stmt = $this->db->prepare($sql);
        // Exécuter la requête
        return $stmt->execute($data);
    }
    public function AlreadyUseLogin($login)
    {
        $query = "SELECT COUNT(*) as count FROM users WHERE login = :login";

        // Utilisation de prepared statements pour éviter les injections SQL
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);

        $stmt->execute();

        // Récupérer le résultat
        $count = $stmt->fetchColumn();

        // Si le compte est supérieur à zéro, le login est déjà utilisé par un autre utilisateur
        return $count > 0;
    }

    public function delete(int $student_id)
    {
        $sql = "DELETE FROM `students` WHERE `student_id` = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}