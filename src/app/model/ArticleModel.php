<?php

namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\ArticleEntity;

class ArticleModel extends Model {
    protected string $table = 'articles';

    public function getEntity() {
        return ArticleEntity::class;
    }

    public function dettes($id) {
        return $this->belongsToMany(DetteModel::class, 'dettearticles', 'articlesId', 'dettesId', $id);
    }

    // public function findByReference($reference) {
    //     $sql = "SELECT * FROM $this->table WHERE reference = :reference";
    //     return $this->database->prepare($sql, ['reference' => $reference], true);
    // }

    public function findByReference($reference) {
        $sql = "SELECT * FROM $this->table WHERE reference = :reference";
        return $this->database->prepare($sql, ['reference' => $reference], $this->getEntity(), true);
    }
    
}
