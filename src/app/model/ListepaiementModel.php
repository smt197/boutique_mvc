<?php

namespace App\App\Model;
use App\Core\Model\Model;
use App\App\Entity\PaiementEntity;

class ListepaiementModel extends Model
{
    protected string $table = 'paiements';

    public function getEntity()
    {
        return PaiementEntity::class;
    }

    public function getPaiementsByDetteId($detteId)
    {
        $sql = "SELECT * FROM $this->table WHERE dettesId = :dettesId";
        return $this->database->prepare($sql, ['dettesId' => $detteId], $this->getEntity());
    }

    public function getTotalPaiementsByDetteId($detteId)
    {
        $sql = "SELECT SUM(montant) as total_paiements FROM $this->table WHERE dettesId = :dettesId";
        return $this->database->prepare($sql, ['dettesId' => $detteId], $this->getEntity(), true);
    }
}
