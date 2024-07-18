<?php namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class ListePaiementController extends Controller {
    private $listePaiementModel;
    private $detteModel;

    public function __construct()
    {
        $this->listePaiementModel = App::getInstance()->getModel("listepaiement");
        $this->detteModel = App::getInstance()->getModel("dette");
    }

    public function afficherListePaiement()
    {
        $detteId = $_POST['id'] ?? $_GET['id'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 2;

        if ($detteId) {
            $dette = $this->detteModel->getDetteById($detteId);
            $paiements = $this->listePaiementModel->getPaiementsByDetteId($detteId);
            $totalPaiements = $this->listePaiementModel->getTotalPaiementsByDetteId($detteId);

            if ($dette && $paiements) {
                $utilisateurModel = App::getInstance()->getModel("utilisateur");
                $utilisateur = $utilisateurModel->findById($dette->utilisateursId);

                if ($utilisateur) {
                    $totalItems = count($paiements);
                    $totalPages = ceil($totalItems / $perPage);
                    $offset = ($page - 1) * $perPage;

                    $paginatedPaiements = array_slice($paiements, $offset, $perPage);

                    $this->renderView('listepaiement', [
                        'dette' => $dette,
                        'utilisateur' => $utilisateur,
                        'paiements' => $paginatedPaiements,
                        'total_paiements' => $totalPaiements->total_paiements,
                        'currentPage' => $page,
                        'totalPages' => $totalPages,
                        'detteId' => $detteId
                    ]);
                } else {
                    $this->renderView('listepaiement', ['error' => 'Utilisateur non trouvé.']);
                }
            } else {
                $this->renderView('listepaiement', ['error' => 'Aucun paiement trouvé pour cette dette.']);
            }
        } else {
            $this->renderView('listepaiement', ['error' => 'ID de dette non fourni.']);
        }
    }
}