<?php

namespace App\models;
use PDO;
use Exception;

class Bikes {
    private PDO $db;
    public function __construct(
        private int $bike_id = 0, 
        private string $registration_number = '', 
        private int $availability = 0,
        private string $photo = '',
        private string $description = '',
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
     * @param integer $bike_id
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


    public function create(array $data)
    {
        $sql = <<<EOD
        INSERT INTO `bikes` (
            `registration_number`,
            `availability`,
            `photo`
        ) 
        VALUES (
            :registration_number,
            :availability,
            :photo
        )
        EOD;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function AlreadyUseRegistration($registration_number)
    {
        $query = "SELECT COUNT(*) as count FROM bikes WHERE registration_number = :registration_number";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':registration_number', $registration_number, PDO::PARAM_STR);

        $stmt->execute();

        $count = $stmt->fetchColumn();
        
        return $count > 0;
    }


}