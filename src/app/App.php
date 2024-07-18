<?php

namespace App\App;
use App\Core\Database\MysqlDatabase;
use Dotenv\Dotenv;

class App{
    private static $instance;
    private $database;
    
    public function __construct(){

    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    // public function getDatabase(){
    //     if ($this->database === null) {
    //         $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    //         $dotenv->load();

    //         $this->database =new MysqlDatabase($_ENV['DSN'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD']);
    //     }
    //     return $this->database;
    // }

    public function getDatabase() {
        if ($this->database === null) {
            require_once '../config.php';
            $this->database = getDatabaseInstance();
        }
        return $this->database;
    }

    public function getModel($model)
    {
        $modelClass = "App\\App\\Model\\" . ucfirst($model) . "Model";
        $newModel = new $modelClass($this->getDatabase());
        // $newModel->setDatabase($this->getDatabase());
        
        return $newModel;
    }

    public static function notFound(){

        require_once __DIR__ . "/../../views/notFaund.html.php";
    }

    public function forbidden(){

    }
}