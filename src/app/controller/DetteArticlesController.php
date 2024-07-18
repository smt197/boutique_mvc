<?php namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class DetteArticlesController extends Controller {
    private $detteModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
    }

    public function afficherArticles() {
        $page = $_SERVER['REQUEST_URI'];
        $detteId = $_POST['articles'] ?? $_GET['detteId'] ?? null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // var_dump($_GET['page'] );
        $perPage = 2; // Vous avez mentionné 5 articles par page

        if ($detteId) {
            $dette = $this->detteModel->getDetteById($detteId);
            $articles = $this->detteModel->articles($detteId);
            $utilisateur = $dette ? $this->detteModel->utilisateur($dette->utilisateursId) : null;

            $totalArticles = count($articles);
            $totalPages = ceil($totalArticles / $perPage);
            $offset = ($page - 1) * $perPage;

            $paginatedArticles = array_slice($articles, $offset, $perPage);

            $this->renderView('dettearticles', [
                'dette' => $dette,
                'articles' => $paginatedArticles,
                'utilisateur' => $utilisateur,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'detteId' => $detteId
            ]);
        } else {
            // Initialiser les variables pour éviter les erreurs dans la vue
            $this->renderView('dettearticles', [
                'dette' => null,
                'articles' => [],
                'utilisateur' => null,
                'currentPage' => $page,
                'totalPages' => 0,
                'detteId' => $detteId,
                'error' => 'Aucune dette sélectionnée.'
            ]);
        }
    }
}
