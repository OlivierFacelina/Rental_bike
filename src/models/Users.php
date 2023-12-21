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

//fonction pour tester l'authentification 
public  function authUser($login){
    $sql = "SELECT 
     `users`.`firstname`,
     `users`.`lastname`, 
     `users`.`role_id`, 
     `users`.`login`, 
     `users`.`user_id`, 
     `users`.`password`
    FROM `users` 
    WHERE `users`.`login` = :login" ;
        $stmt = $this->db->prepare($sql);
        // Lier le paramètre avec la valeur envoyée
        $stmt->bindValue(':login', $login, PDO::PARAM_INT);
        // $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        // Exécuter la requête
        if (!$stmt->execute()) {
        throw new Exception('La requête a échouée');
        }

return $stmt->fetch();
}

///fonction pour le dasbord , pour afficher les comptes des utilisateurs
    public function all_user(){
        $sql = "SELECT 
     `users`.`firstname`,
     `users`.`lastname`, 
     `users`.`user_id`, 
     `users`.`login`, 
     `users`.`role_id`, 
     `users`.`password`
    FROM `users`  WHERE `users`.`role_id` = 2" ;
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
        throw new Exception('La requête a échouée');
        }

    return $stmt->fetchAll();
    }  

    // /**
    //  * Récupère l'étudiant ayant l'id renseigné
    //  *
    //  * @param integer $user_id
    //  * @return object
    //  */
    
    
    public function edit($firstname,$lastname,$login,$user_id)
    {
        $sql = "UPDATE `users` 
                SET
                    `firstname` = :firstname, 
                    `lastname` = :lastname, 
                    `login`= :login
                      WHERE `user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':login', $login, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id,PDO::PARAM_INT);
        // Exécuter la requête
        return $stmt->execute();
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

    public function delete(int $user_id)
    {
        $sql = "DELETE FROM `reservations` WHERE `user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        if ($stmt->execute()) {         
            $sql2 = "DELETE FROM `users` WHERE `user_id` = :user_id";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt2->execute();
        }
        return true;
        
    }
    public function find_user($user_id){
                    $sql = "SELECT 
                    `users`.`firstname`,
                    `users`.`lastname`,  
                    `users`.`login`                      
            FROM `users` 
            WHERE `users`.`user_id` = :user_id";
            $stmt = $this->db->prepare($sql);
            // Lier le paramètre avec la valeur envoyée
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            // Exécuter la requête
            if (!$stmt->execute()) {
            throw new Exception('La requête a échouée');
            }

            return $stmt->fetch();
    }
    public function find(int $user_id)
    {
        $sql = "SELECT 
                     `users`.`firstname`,
                     `users`.`lastname`,  
                     `bikes`.`registration_number`,  
                     `bikes`.`photo`,  
                     `reservations`.`bike_id`, 
                     `reservations`.`res_num`, 
                     `reservations`.`res_date`, 
                     `reservations`.`start_date`, 
                     `reservations`.`end_date`, 
                     `reservations`.`status`, 
                     `reservations`.`bike_id`                       
                FROM `users` 
                JOIN `reservations` ON `users`.`user_id` = `reservations`.`user_id`
                JOIN `bikes` ON `reservations`.`bike_id` = `bikes`.`bike_id`
                WHERE `users`.`user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        // Lier le paramètre avec la valeur envoyée
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        // Exécuter la requête
        if (!$stmt->execute()) {
            throw new Exception('La requête a échouée');
        }
    
        return $stmt->fetchAll();
    }
}