<?php
namespace App\App\Controller;
use App\Core\Controller;
use App\App\App;
use App\Core\Validator;

class HomeController extends Controller {
    private $homeModel;
    private $validator;

    public function __construct() {
        $this->homeModel = App::getInstance()->getModel("utilisateur");
        $this->validator = new Validator();
    }

    public function login() {
        $home = $this->homeModel->all();
        $this->renderView('home', ['home' => $home]);
    }

  

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'email' => 'required|email',
                'motDePasse' => 'required'
            ];

            if ($this->validator->validate($_POST, $rules)) {
                $this->homeModel->save($_POST);
                $this->redirect('/utilisateurs');
            } else {
                $errors = $this->validator->getErrors();
                $this->renderView('home', ['errors' => $errors]);
            }
        } else {
            $this->renderView('home');
        }
    }

    // Ajoutez d'autres méthodes selon vos besoins
}