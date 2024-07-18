<?php

namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class SaveDetteController extends Controller {
    private $saveDetteModel;
    private $articleModel;

    public function __construct() {
        parent::__construct();  
        $this->saveDetteModel = App::getInstance()->getModel("saveDette");
        $this->articleModel = App::getInstance()->getModel("article");
    }

    public function afficherFormulaire() {
        $telephone = $_POST['telephoneClient'] ?? '';
        if ($telephone) {
            $utilisateurModel = App::getInstance()->getModel("utilisateur");
            $utilisateur = $utilisateurModel->findByTelephone($telephone);
            if ($utilisateur) {
                $articles = $this->session->get('articles') ?? [];
                $this->renderView('savedette', [
                    'utilisateur' => $utilisateur,
                    'articles' => $articles,
                    'telephone' => $telephone
                ]);
            } else {
                $this->renderView('savedette', [
                    'error' => 'Aucun utilisateur trouvé avec ce numéro de téléphone.'
                ]);
            }
        } else {
            $this->renderView('savedette');
        }
    }

    public function rechercherArticle() {
        $reference = $_POST['reference'] ?? '';
        $telephone = $_POST['telephoneClient'] ?? '';
        if ($reference) {
            $article = $this->articleModel->findByReference($reference);
            $utilisateurModel = App::getInstance()->getModel("utilisateur");
            $utilisateur = $utilisateurModel->findByTelephone($telephone);
            if ($article) {
                $articles = $this->session->get('articles') ?? [];
                $this->renderView('savedette', [
                    'article' => $article,
                    'reference' => $reference,
                    'telephone' => $telephone,
                    'articles' => $articles,
                    'utilisateur' => $utilisateur
                ]);
            } else {
                $this->renderView('savedette', [
                    'error' => 'Aucun article trouvé avec cette référence.',
                    'reference' => $reference,
                    'telephone' => $telephone,
                    'utilisateur' => $utilisateur
                ]);
            }
        }
    }

    public function ajouterArticle() {
        $reference = $_POST['reference'] ?? '';
        $telephone = $_POST['telephoneClient'] ?? '';
        $quantite = $_POST['quantite'] ?? 0;
        if ($reference) {
            $article = $this->articleModel->findByReference($reference);
            $utilisateurModel = App::getInstance()->getModel("utilisateur");
            $utilisateur = $utilisateurModel->findByTelephone($telephone);
            if ($article) {
                if ($quantite <= $article->qteStock) {
                    $articles = $this->session->get('articles') ?? [];
                    $articles[] = [
                        'id' => $article->id,
                        'libelle' => $article->libelle,
                        'prix' => $article->prix,
                        'quantite' => $quantite
                    ];
                    $this->session->set('articles', $articles);
                    $this->renderView('savedette', [
                        'articles' => $articles,
                        'telephone' => $telephone,
                        'utilisateur' => $utilisateur
                    ]);
                } else {
                    $this->renderView('savedette', [
                        'error' => 'Quantité demandée supérieure à la quantité en stock.',
                        'reference' => $reference,
                        'telephone' => $telephone,
                        'utilisateur' => $utilisateur
                    ]);
                }
            } else {
                $this->renderView('savedette', [
                    'error' => 'Aucun article trouvé avec cette référence.',
                    'reference' => $reference,
                    'telephone' => $telephone,
                    'utilisateur' => $utilisateur
                ]);
            }
        }
    }

    public function enregistrerDette() {
        $telephone = $_POST['telephoneClient'] ?? '';
        $articles = $this->session->get('articles') ?? [];
        if ($telephone && !empty($articles)) {
            $utilisateurModel = App::getInstance()->getModel("utilisateur");
            $utilisateur = $utilisateurModel->findByTelephone($telephone);
            if ($utilisateur) {
                $this->saveDetteModel->enregistrerNouvelleDette($utilisateur->id, $articles);
                $this->session->remove('articles');
                $this->renderView('savedette', [
                    'success' => 'Dette enregistrée avec succès.',
                    'utilisateur' => $utilisateur
                ]);
            } else {
                $this->renderView('savedette', [
                    'error' => 'Aucun utilisateur trouvé avec ce numéro de téléphone.'
                ]);
            }
        } else {
            $this->renderView('savedette', [
                'error' => 'Veuillez ajouter des articles à la dette.'
            ]);
        }
    }

    public function effacerArticles() {
        // Vider les articles de la session
        unset($_SESSION['articles']);
        // Rediriger vers la page de sauvegarde de la dette
        $this->renderView('savedette');
    }
}

