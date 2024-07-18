<?php

namespace App\App\Model;
use App\Core\Model\Model;
use App\App\Entity\DetteEntity;

class DetteModel extends Model
{
    protected string $table = 'dettes';

    public function getEntity()
    {
        return DetteEntity::class;
    }

    public function utilisateur($id) {
        return $this->belongsTo(UtilisateurModel::class, $id, 'utilisateursId');
    }

    public function articles($id) {
        return $this->belongsToMany(ArticleModel::class, 'dettearticles', 'dettesId', 'articlesId', $id);
    }

    public function getTotalDettesByUtilisateurId($utilisateurId)
    {
        $sql = "
            SELECT 
                IFNULL(SUM(montant_total), 0) as total_dette, 
                IFNULL(SUM(montant_verse), 0) as total_verse, 
                IFNULL(SUM(montant_restant), 0) as total_restant
            FROM $this->table 
            WHERE utilisateursId = :utilisateurId
        ";
        return $this->database->prepare($sql, ['utilisateurId' => $utilisateurId], $this->getEntity(), true);
    }

    public function getPaidDettesByUtilisateurId($utilisateurId)
    {
        $sql = "
            SELECT 
                *
            FROM $this->table 
            WHERE utilisateursId = :utilisateurId AND montant_total > 0 AND montant_restant = 0
        ";
        return $this->database->prepare($sql, ['utilisateurId' => $utilisateurId], $this->getEntity());
    }

    public function findNonPayeesByUtilisateurId($utilisateurId) {
        $sql = "SELECT * FROM $this->table WHERE utilisateursId = :utilisateurId AND montant_restant > 0";
        return $this->database->prepare($sql, ['utilisateurId' => $utilisateurId], $this->getEntity());
    }

    public function updateDette($id, $data)
    {
        $sql = "UPDATE $this->table SET montant_verse = :montant_verse, montant_restant = :montant_restant WHERE id = :id";
        return $this->database->prepare($sql, array_merge($data, ['id' => $id]));
    }

    public function getDetteById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        return $this->database->prepare($sql, ['id' => $id], $this->getEntity(), true);
    }
}
