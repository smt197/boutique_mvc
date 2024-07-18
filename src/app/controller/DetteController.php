<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class DetteController extends Controller {
    private $detteModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
    }

    public function listeDette() {
        $telephone = $_POST['telephone'] ?? '';
        $statut = $_POST['statut'] ?? 'non_paye';
        $utilisateurModel = App::getInstance()->getModel("utilisateur");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $dettes = $this->detteModel->findNonPayeesByUtilisateurId(0);
            $this->renderView('listedette', ['dettes' => $dettes, 'statut' => 'non_paye']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $utilisateur = $utilisateurModel->findByTelephone($telephone);
            if ($utilisateur) {
                if ($statut == 'paye') {
                    $dettes = $this->detteModel->getPaidDettesByUtilisateurId($utilisateur->id);
                } else {
                    $dettes = $this->detteModel->findNonPayeesByUtilisateurId($utilisateur->id);
                }
                $this->renderView('listedette', ['utilisateur' => $utilisateur, 'dettes' => $dettes, 'statut' => $statut]);
            } else {
                $this->renderView('listedette', ['error' => 'Aucun utilisateur trouvé avec ce numéro de téléphone.', 'dettes' => [], 'statut' => $statut]);
            }
        }
    }
}
