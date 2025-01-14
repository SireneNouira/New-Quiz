<?php

abstract class AbstractRepository {
    protected PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=new_quiz", "root", "");
    }
}