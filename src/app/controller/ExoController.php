<?php
    namespace App\App\Controller;

    use App\Core\Controller;
    use App\App\App;
    use App\Core\Validator;
    
    class ExoController extends Controller {
        private $Exo;
        private $validator;
    
        public function __construct() {
            $this->Exo = App::getInstance()->getModel("utilisateur");
            $this->validator = new Validator();
        }
    
        public function exo($id, $date) {
            echo "ID: " . $id . "<br>";
            echo "Date: " . $date . "<br>";
            $home = $this->Exo->all();
            $this->renderView('exo', ['exo' => $home]);
        }
    
        public function create() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rules = [
                    'email' => 'required|email',
                    'motDePasse' => 'required'
                ];
    
                if ($this->validator->validate($_POST, $rules)) {
                    $this->Exo->save($_POST);
                    $this->redirect('/utilisateurs');
                } else {
                    $errors = $this->validator->getErrors();
                    $this->renderView('exo', ['errors' => $errors]);
                }
            } else {
                $this->renderView('exo');
            }
        }
    }
    