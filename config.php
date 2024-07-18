<?php

use App\Core\Database\MysqlDatabase;
use Dotenv\Dotenv;

function getDatabaseInstance() {
    static $database = null;

    if ($database === null) {
        // Assurez-vous que le chemin ici est correct
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $database = new MysqlDatabase($_ENV['DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    return $database;
}