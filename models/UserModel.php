<?php
class UserModel {
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    // user erstellen
    public function createUser($name, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (name, password) VALUES (?, ?)");
        return $stmt->execute([$name, $password]);
    }

    // user löschen
    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // user bearbeiten
    public function updateUser($id, $name, $password)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET name = ?, password = ? WHERE id = ?");
        return $stmt->execute([$name, $password, $id]);
    }

    // user prüfen ob er existiert
    public function fetchUser($name, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
        $stmt->execute([$name, $password]);
        return $stmt->fetch();
    }
}