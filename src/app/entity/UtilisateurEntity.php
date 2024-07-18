<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;

class UtilisateurEntity extends Entity
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $motdepasse;
    private string $photo;
    private string $telephone;
    private string $rolesId;
    // public $dettes = [];

    public function __construct()
    {
        // Constructeur vide ou ajouter une logique spécifique si nécessaire
    }

    // Pas besoin d'ajouter les getters, ils sont gérés par les méthodes magiques de la classe parente Entity
}
