<?php

//Configuration class to connect with database
class Configuration {
    const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    const HOST = 'localhost';
    const DATABASE = 'books';
    CONST USER = 'root';
    CONST PASSWORD = '';
    CONST PORT = 3306;

    public static function getDSN(): string{
        return "mysql:host=".self::HOST.";dbname=".self::DATABASE."port=".self::PORT.";dbname=".self::DATABASE.";charset=utf8";
    }
}

//Connection class to connect with database using singleton pattern
class Connection {
    private static $singleton;
    private PDO $pdo;

    private function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public static function getInstance(): ?self {
        if(self::$singleton == null) {
            self::$singleton = new self(
                new PDO(
                    Configuration::getDSN(),
                    Configuration::USER,
                    Configuration::PASSWORD,
                    Configuration::OPTIONS
                ));
        }

        return self::$singleton;
    }

    public function getPdo(): ?PDO {
        return $this->pdo;
    }
}

$books = Connection::getInstance()->getPdo()->query("SELECT * FROM books")->fetchAll();
var_dump($books);