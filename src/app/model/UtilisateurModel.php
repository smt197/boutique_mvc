<?php

namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\UtilisateurEntity;

class UtilisateurModel extends Model
{
    protected string $table = 'utilisateurs';

    public function getEntity()
    {
        return UtilisateurEntity::class;
    }

    public function save(array $data)
    {
        $sql = "INSERT INTO $this->table (nom, prenom, telephone, email, motdepasse, photo, rolesId) VALUES (:nom, :prenom, :telephone, :email, :motdepasse, :photo, :rolesId)";
        $this->database->prepare($sql, [
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':telephone' => $data['telephone'],
            ':email' => $data['email'],
            ':motdepasse' => password_hash($data['motdepasse'] ?? 'passer123', PASSWORD_BCRYPT), // Use default password if not provided
            ':photo' => $data['photo'],
            ':rolesId' => $data['rolesId']?? 2
        ]);
    }

    public function findByTelephone($telephone)
    {
        $sql = "SELECT * FROM $this->table WHERE telephone = :telephone";
        return $this->database->prepare($sql,['telephone' => $telephone], $this->getEntity(), true);
    }
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        return $this->database->prepare($sql, ['email' => $email], $this->getEntity(), true);
    }

    public function findByPhoto($photo)
    {
        $sql = "SELECT * FROM $this->table WHERE photo = :photo";
        return $this->database->prepare($sql, ['photo' => $photo], $this->getEntity(), true);
    }
    


    public function dettes($id) {
        return $this->hasMany(DetteModel::class, 'utilisateursId', $id);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        return $this->database->prepare($sql, ['id' => $id], $this->getEntity(), true);
    }
    
} 
