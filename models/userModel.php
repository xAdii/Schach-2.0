<?php
class userModel {
    private $pdo;
    public function __construct($pdo)
    {
        $this->$pdo = $pdo;
    }
    
    // user erstellen
    public function create_user($name, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
        return $stmt->execute([$name, $password]);
    }

    // user löschen

    // user bearbeiten

    // user prüfen ob er existiert

}