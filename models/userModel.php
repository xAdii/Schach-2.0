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
        $stmt = $this->pdo->prepare("INSERT INTO user (name, password) VALUES (?, ?)");
        return $stmt->execute([$name, $password]);
    }

    // user löschen
    public function delete_user($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // user bearbeiten
    public function update_user($id, $name, $password)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET name = ?, password = ? WHERE id = ?");
        return $stmt->execute([$name, $password, $id]);
    }

    // user prüfen ob er existiert

}