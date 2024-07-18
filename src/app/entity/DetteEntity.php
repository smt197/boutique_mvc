<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;

class DetteEntity extends Entity
{
    private int $id;
    private string $date;
    private float $montant_total;
    private float $montant_verse;
    private float $montant_restant;
    private int $utilisateursId;
    private float $total_verse;
    private float $total_restant;

    private float $total_dette;
    // public $articles = [];

    public function __construct()
    {
        
    }
}