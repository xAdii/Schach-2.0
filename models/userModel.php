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
    public function delete_user($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // user bearbeiten

    // user prüfen ob er existiert

}