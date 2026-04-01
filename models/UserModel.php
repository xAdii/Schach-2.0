<?php
class UserModel
{
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
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE ID = ?");
        return $stmt->execute([$id]);
    }

    // user Passwort bearbeiten
    public function updateUserPassword($id, $password)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET password = ? WHERE ID = ?");
        return $stmt->execute([$password, $id]);
    }

    // user namen ändern
    public function updateUserName($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET name = ? WHERE ID = ?");
        return $stmt->execute([$name, $id]);
    }

    // user prüfen ob er existiert
    public function fetchUser($name)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch();
    }
}
