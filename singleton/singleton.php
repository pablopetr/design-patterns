<?php

class Singleton {
    private static $singleton;

    public $x;
    private function __construct() {}

    public static function getInstance(): ?self {
        if(self::$singleton == null) {
            self::$singleton = new self();
        }
        return self::$singleton;
    }
}
//First instance of class
$object1 = Singleton::getInstance();
//Setting x = 1 for first instance of class
$object1->x = 1;

//Getting existing instance of class
$object2 = Singleton::getInstance();
//Setting x = 2 for the unique instance of class
$object2->x++;

//Show all objects
var_dump($object1);
var_dump($object2);