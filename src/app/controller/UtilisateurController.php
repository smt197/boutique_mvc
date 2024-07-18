<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class UtilisateurController extends Controller {
    private $utilisateurModel;
    private $detteModel;

    public function __construct() {
        parent::__construct();
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->detteModel = App::getInstance()->getModel("dette");
    }

    public function index() {
        $utilisateurs = $this->utilisateurModel->all();
        $this->renderView('utilisateurs', ['utilisateurs' => $utilisateurs]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'nom' => 'required|text',
                'prenom' => 'required|text',
                'email' => 'required|email',
                'telephone' => 'required|telephone',
                'photo' => 'required|photo'
            ];

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photoTmpPath = $_FILES['photo']['tmp_name'];
                $photoExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $photoName = uniqid() . '_' . time() . '.' . $photoExtension;
                $photoPath = "../public/img/uploads/$photoName";
                if (move_uploaded_file($photoTmpPath, $photoPath)) {
                    $_POST['photo'] = $photoName;
                } else {
                    $this->validator->addError('photo', "Erreur lors de l'upload de l'image");
                }
            } else {
                $this->validator->addError('photo', "Le champ photo est obligatoire");
            }

            if ($this->validator->validate($_POST, $rules)) {
                try {
                    $this->utilisateurModel->save($_POST);
                    $_POST = [];
                    $this->renderView('utilisateurs', ['success' => 'Utilisateur ajouté avec succès']);
                } catch (\Exception $e) {
                    $this->validator->addError('general', 'Une erreur est survenue lors de l\'ajout de l\'utilisateur');
                    $errors = $this->validator->getErrors();
                    $this->renderView('utilisateurs', ['errors' => $errors, 'data' => $_POST]);
                }
            } else {
                $errors = $this->validator->getErrors();
                $this->renderView('utilisateurs', ['errors' => $errors, 'data' => $_POST]);
            }
        } else {
            $this->renderView('utilisateurs');
        }
    }

    public function checkDettes() {
        $utilisateurId = $_POST['utilisateurId'] ?? 0;
        $paidDettes = $this->detteModel->getPaidDettesByUtilisateurId($utilisateurId);

        if (!empty($paidDettes)) {
            $detteStatus = 'payée';
        } else {
            $detteStatus = 'non payée';
        }

        $this->renderView('utilisateurs', ['dette_status' => $detteStatus]);
    }

    public function searchUser() {
        $telephone = $_POST['telephone'] ?? '';
        $utilisateur = $this->utilisateurModel->findByTelephone($telephone);
        if ($utilisateur) {
            $dettes = $this->detteModel->getTotalDettesByUtilisateurId($utilisateur->id);
            sleep(2 );   
            $data['utilisateur'] = $utilisateur;
            $data['dettes'] = $dettes;
        } else {
            $data['error'] = 'Aucun utilisateur trouvé avec ce numéro de téléphone.';
        }

        $this->renderView('utilisateurs', $data);
    }
}
