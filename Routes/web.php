<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Core\Route;

require_once '../vendor/autoload.php';

$route = new Route();

$route->get('home', 'HomeController=>login');
$route->get('dette/add/#id#/#date#', 'ExoController=>exo');

$route->get('utilisateurs', 'UtilisateurController=>index');
$route->post('utilisateurs', 'UtilisateurController=>create'); 
$route->post('seach', 'UtilisateurController=>recherche');

$route->get("test", "UtilisateurController=>searchUser");
$route->post("test", "UtilisateurController=>searchUser");

$route->get("listedette", "DetteController=>listeDette");
$route->post("listedette", "DetteController=>listeDette"); 

$route->post("effectuerPaiement", "PaiementController=>effectuerPaiement");
$route->post("paiement", "PaiementController=>afficherPaiement");


$route->get("listepaiement/#id#/#page#", "ListePaiementController=>afficherListePaiement");
$route->post("listepaiement", "ListePaiementController=>afficherListePaiement");
// Dans votre fichier de routes
// $route->get('articlesdette', 'DetteArticlesController=>afficherArticles');
$route->get('articlesdette/#articles#/#page#', 'DetteArticlesController=>afficherArticles');
$route->post('articlesdette', 'DetteArticlesController=>afficherArticles');



    $route->post('afficherFormulaire', 'SaveDetteController=>afficherFormulaire');
    $route->post('rechercherarticle', 'SaveDetteController=>rechercherArticle');
    $route->post('ajouterarticle', 'SaveDetteController=>ajouterArticle');
    $route->post('enregistrerdette', 'SaveDetteController=>enregistrerDette');

    $route->post('effacerarticles', 'SaveDetteController=>effacerArticles');















$route->dispatch();

