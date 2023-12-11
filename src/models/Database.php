<?php

namespace App\models;
use PDO;
use PDOException;

class Database {
    
    const DB_USER = 'root';
    const DB_PWD = '';
    const DB_NAME = 'rental';
    const DB_HOST = 'localhost';

/**
 * Connexion PDO à la bdd
 * @return PDO | PDOException
 */

    private static PDO|null $instance = null;
public static function db_connect(): PDO|PDOException
{

    $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    try {
        if(is_null(self::$instance)) {
            self::$instance = new PDO($dsn, self::DB_USER, self::DB_PWD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }
        return self::$instance;
    } catch (PDOException $ex) {
        echo sprintf('La connexion a échouée avec l\'erreur %s', $ex->getMessage());
        die();
    }
}

}