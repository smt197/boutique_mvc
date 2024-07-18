<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;

class PaiementEntity extends Entity
{
    private int $id;
    private string $date;
    private float $montant;
    private int $dettesId;
    protected ?float $total_paiements = null;

    public function __construct()
    {
        
    }
}