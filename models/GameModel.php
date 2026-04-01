<?php
class BoardModel
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertBoard($playerWhiteID, $playerBlackID)
    {
        $stmt = $this->pdo->prepare("INSERT INTO boards (playerWhiteID, playerBlackID) VALUES (?, ?)");
        return $stmt->execute([$playerWhiteID, $playerBlackID]);
    }

    public function fetchBoard($boardID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM boards WHERE ID = ?");
        $stmt->execute([$boardID]);
        return $stmt->fetch();
    }

    public function fetchMaxBoardID()
    {
        $stmt = $this->pdo->prepare("SELECT MAX(ID) AS ID FROM boards");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insertPiece($boardID, $type, $color, $position_y, $position_x)
    {
        $stmt = $this->pdo->prepare("INSERT INTO pieces (boardID, type, color, position_y, position_x) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$boardID, $type, $color, $position_y, $position_x]);
    }

    public function fetchPieces($boardID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pieces WHERE boardID = ?");
        $stmt->execute([$boardID]);
        return $stmt->fetchAll();
    }
}
