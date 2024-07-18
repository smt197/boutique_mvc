<?php
namespace App\App\Controller;

use App\Core\Controller;

class ErrorController extends Controller {
    public static function notFound() {
        $instance = new self();
        $instance->renderView('notFaund'); // Utilisez uniquement le nom du fichier sans chemin
    }
}
?>
