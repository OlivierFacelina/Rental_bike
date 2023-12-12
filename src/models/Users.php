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
        private string $role_id = ''
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
    public function updatePassword()
{
    $sql = "SELECT `user_id`, `password` FROM `users`";
    $stmt = $this->db->prepare($sql);

    if (!$stmt->execute()) {
        throw new Exception('La requête a échoué');
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user_id = $row['user_id'];
        $password = $row['password'];

        // Hasher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Mettre à jour le mot de passe hashé dans la table
        $update_query = "UPDATE users SET password = :hashed_password WHERE user_id = :user_id";
        $update_stmt = $this->db->prepare($update_query);
        $update_stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if (!$update_stmt->execute()) {
            throw new Exception('La mise à jour du mot de passe a échoué pour l\'utilisateur avec l\'ID ' . $user_id);
        }
    }
    return $stmt->fetchAll();

    // Vous pouvez retourner quelque chose si nécessaire, sinon, vous pouvez laisser vide.
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
        $sql = "INSERT INTO `students`(
                    `firstname`, 
                    `lastname`, 
                    `birthdate`,  
                    `phone`, 
                    `email`, 
                    `address`, 
                    `postal_code`, 
                    `city`, 
                    `grade`) 
                VALUES (
                    :firstname, 
                    :lastname, 
                    :birthdate,  
                    :phone, 
                    :email, 
                    :address, 
                    :postal_code, 
                    :city, 
                    :grade)";
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