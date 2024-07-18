<?php

namespace App\App\Model;
use App\Core\Model\Model;
use App\App\Entity\PaiementEntity;

class PaiementModel extends Model
{
    protected string $table = 'paiements';

    public function getEntity()
    {
        return PaiementEntity::class;
    }

    public function createPaiement($data)
    {
        $sql = "INSERT INTO $this->table (montant, dettesId) VALUES (:montant, :dettesId)";
        return $this->database->prepare($sql, $data);
    }
}
