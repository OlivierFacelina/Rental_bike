<?php

// namespace App\models;
// use PDO;
// use Exception;

// /**
//  * Student
//  */
// class Bikes {
//     private PDO $db;
//     public function __construct(
//         private int $bike_id = 0, 
//         private string $registration_number = '', 
//         private int $availability = 0,
//         private string $photo = '',
//         private string $description = '',
//     ) {
//         $this->db = Database::db_connect();
//     }

//     public function fullName(): string {
//         return $this->firstname . ' ' . $this->lastname;
//     }

//     public function __get($name) {
//         if(property_exists($this, $name)) {
//             return $this->$name;
//         }
//     }

//     public function all(): array
//     {
//         $parms = [];

//         $sql = "SELECT 
//                     `bike_id`, `registration_number`, `availability`, `photo`, `description` 
//                 FROM `bikes`";
//         $stmt = $this->db->prepare($sql);
//         if (!$stmt->execute($parms)) {
//             throw new Exception('La requête a échouée');
//         }
//         // FETCH_PROPS_LATE : pour le constructeur 
//         $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\App\Models\Bikes');
//         return $stmt->fetchAll();
//     }

//     /**
//      * Récupère l'étudiant ayant l'id renseigné
//      *
//      * @param integer $student_id
//      * @return object
//      */
//     public function find(int $bike_id)
//     {
//         $sql = "SELECT 
//                     `bike_id`, `registration_number`, `availability`, 
//                     `photo`, `description`
//                 FROM `bikes` WHERE `bike_id` = :bike_id";
//         $stmt = $this->db->prepare($sql);
//         // Lier le paramètre avec la valeur envoyée
//         $stmt->bindValue(':bike_id', $bike_id, PDO::PARAM_INT);
//         // Exécuter la requête
//         if (!$stmt->execute()) {
//             throw new Exception('La requête a échouée');
//         }

//         return $stmt->fetch();
//     }


//     public function update(array $data)
//     {
//         $sql = "UPDATE `students` SET
//                     `firstname` = :firstname, 
//                     `lastname` = :lastname, 
//                     `birthdate` = :birthdate,  
//                     `phone` = :phone, 
//                     `email` = :email, 
//                     `address` = :address, 
//                     `postal_code` = :postal_code, 
//                     `city` = :city, 
//                     `grade` = :grade 
//                 WHERE `student_id` = :student_id";
//         $stmt = $this->db->prepare($sql);
//         // Exécuter la requête
//         return $stmt->execute($data);
//     }
//     public function create($user_id, $bike_id, $res_num, $registration_number, $availability, $photo, $description)
//     {
//         $sql = "INSERT INTO `bikes`(
//                     `user_id`,
//                     `bike_id`,
//                     `res_num`,
//                     `registration_number`, 
//                     `availability`, 
//                     `photo`,  
//                     `description`)
//                 VALUES (
//                     :user_id,
//                     :bike_id,
//                     :res_num,
//                     :registration_number, 
//                     :availability, 
//                     :photo,  
//                     :description)"; 
//         $stmt = $this->db->prepare($sql);
//         $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
//         $stmt->bindValue(':bike_id', $bike_id, PDO::PARAM_INT);
//         $stmt->bindValue(':res_num', $res_num, PDO::PARAM_INT);
//         $stmt->bindValue(':registration_number', $registration_number, PDO::PARAM_INT);
//         $stmt->bindValue(':availability', $availability, PDO::PARAM_INT);
//         $stmt->bindValue(':photo', $photo, PDO::PARAM_STR_CHAR);
//         $stmt->bindValue(':description', $description, PDO::PARAM_STR_CHAR);

//         // Exécuter la requête
//         return $stmt->execute();
//     }

//     public function delete(int $student_id)
//     {
//         $sql = "DELETE FROM `students` WHERE `student_id` = :student_id";
//         $stmt = $this->db->prepare($sql);
//         $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
//         return $stmt->execute();
//     }

// }