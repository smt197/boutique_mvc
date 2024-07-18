<?php
namespace App\Core\Database;

use \PDO;
use \PDOException;

final class MysqlDatabase {
    private $pdo;

    public function __construct($dsn, $user, $password) {
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
            // echo "Connexion à la base de données réussie";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function prepare(string $sql, array $data = [], string $entityName = '', bool $single = false) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        if ($entityName) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
        }
        if ($single) {
            return $stmt->fetch();
        }
        return $stmt->fetchAll();
    }

    // public function prepare(string $sql, array $data = [], string $entityName = '', bool $single = false) {
    //     $stmt = $this->pdo->prepare($sql);
    //     try {
    //         $stmt->execute($data);
    //     } catch (\PDOException $e) {
    //         echo "SQL Error: " . $e->getMessage();
    //         echo "SQL Query: " . $sql;
    //         echo "Parameters: " . print_r($data, true);
    //         throw $e;
    //     }
    //     if ($entityName) {
    //         $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
    //     }
    //     if ($single) {
    //         return $stmt->fetch();
    //     }
    //     return $stmt->fetchAll();
    // }
    

    public function query(string $sql, string $entityName = '', bool $single = false) {
        $stmt = $this->pdo->query($sql);
        if ($entityName) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
        }
        if ($single) {
            return $stmt->fetch();
        }
        return $stmt->fetchAll();
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollBack() {
        return $this->pdo->rollBack();
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
}
