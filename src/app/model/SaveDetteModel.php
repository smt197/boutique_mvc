<?php

namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\DetteEntity;

class SaveDetteModel extends Model
{
    protected string $table = 'dettes';

    public function getEntity()
    {
        return DetteEntity::class;
    }

    public function enregistrerNouvelleDette($utilisateurId, $articles)
    {
        return $this->transaction(function ($model) use ($utilisateurId, $articles) {
            $montant_total = array_reduce($articles, function ($total, $article) {
                return $total + ($article['prix'] * $article['quantite']);
            }, 0);

            // Insérer la nouvelle dette
            $sqlDette = "INSERT INTO dettes (montant_total, montant_verse, montant_restant, utilisateursId) VALUES (:montant_total, :montant_verse, :montant_restant, :utilisateurId)";
            $paramsDette = [
                ':montant_total' => $montant_total,
                ':montant_verse' => 0,
                ':montant_restant' => $montant_total,
                ':utilisateurId' => $utilisateurId,
            ];
            $model->database->prepare($sqlDette, $paramsDette);

            $detteId = $model->database->lastInsertId();

            // Insérer les articles de la dette
            foreach ($articles as $article) {
                $sqlDetteArticle = "INSERT INTO dettearticles (quantite, dettesId, articlesId) VALUES (:quantite, :dettesId, :articlesId)";
                $paramsDetteArticle = [
                    ':quantite' => $article['quantite'],
                    ':dettesId' => $detteId,
                    ':articlesId' => $article['id'],
                ];
                $model->database->prepare($sqlDetteArticle, $paramsDetteArticle);

                // Diminuer la quantité en stock
                $sqlUpdateStock = "UPDATE articles SET qteStock = qteStock - ? WHERE id = ? AND qteStock >= ?";
                $paramsUpdateStock = [
                    $article['quantite'],
                    $article['id'],
                    $article['quantite']
                ];
                $model->database->prepare($sqlUpdateStock, $paramsUpdateStock);
            }
        });
    }
}
