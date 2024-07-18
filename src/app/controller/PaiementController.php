<?php

namespace App\App\Controller;
use App\Core\Controller;
use App\App\App;

class PaiementController extends Controller {
    private $detteModel;
    private $paiementModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->paiementModel = App::getInstance()->getModel("paiement");
    }

    public function afficherPaiement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $detteId = $_POST['id'];
            if ($detteId) {
                $dette = $this->detteModel->getDetteById($detteId);

                if ($dette) {
                    $utilisateurModel = App::getInstance()->getModel("utilisateur");
                    $utilisateur = $utilisateurModel->findById($dette->utilisateursId);

                    if ($utilisateur) {
                        $this->renderView('paiement', [
                            'dette' => $dette,
                            'utilisateur' => $utilisateur
                        ]);
                    } else {
                        $this->renderView('paiement', ['error' => 'Utilisateur non trouvé.']);
                    }
                } else {
                    $this->renderView('paiement', ['error' => 'Dette non trouvée.']);
                }
            } else {
                $this->renderView('paiement', ['error' => 'ID de dette non fourni.']);
            }
        } else {
            $this->renderView('paiement', ['error' => 'Méthode non autorisée.']);
        }
    }

    public function effectuerPaiement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dette_id'])) {
            $detteId = $_POST['dette_id'];
            var_dump($_POST['dette_id'] );
            $montantVerse = $_POST['montant'] ?? null;

            if ($detteId && $montantVerse !== null) {
                $dette = $this->detteModel->getDetteById($detteId);

                if ($dette && $montantVerse <= $dette->montant_restant) {
                    $newMontantVerse = $dette->montant_verse + $montantVerse;
                    $newMontantRestant = $dette->montant_restant - $montantVerse;

                    $this->detteModel->updateDette($detteId, [
                        'montant_verse' => $newMontantVerse,
                        'montant_restant' => $newMontantRestant
                    ]);

                    $this->paiementModel->createPaiement([
                        'montant' => $montantVerse,
                        'dettesId' => $detteId
                    ]);

                    $this->renderView('paiement', ['success' => 'Paiement effectué avec succès.']);
                } else {
                    $this->renderView('paiement', ['error' => 'Le montant à verser est invalide ou supérieur au montant restant.']);
                }
            } else {
                $this->renderView('paiement', ['error' => 'Paramètres de paiement invalides.']);
            }
        } else {
            $this->renderView('paiement', ['error' => 'Méthode non autorisée.']);
        }
    }
}


