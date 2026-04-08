<?php
class GameModel
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

    public function fetchBoardsByUserID($userID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM boards WHERE playerWhiteID = ? OR playerBlackID = ? ORDER BY ID DESC");
        $stmt->execute([$userID, $userID]);
        return $stmt->fetchAll();
    }

    public function fetchMaxBoardID()
    {
        $stmt = $this->pdo->prepare("SELECT MAX(ID) AS ID FROM boards");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function setBoardTurn($boardID, $turn)
    {
        $stmt = $this->pdo->prepare("UPDATE boards SET turn = ? WHERE ID = ?");
        return $stmt->execute([$turn, $boardID]);
    }

    public function getBoardTurn($boardID)
    {
        $stmt = $this->pdo->prepare("SELECT turn FROM boards WHERE ID = ?");
        $stmt->execute([$boardID]);
        return $stmt->fetchColumn();
    }

    public function deleteBoard($boardID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM boards WHERE ID = ?");
        return $stmt->execute([$boardID]);
    }

    public function deletePiecesByBoardID($boardID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pieces WHERE boardID = ?");
        return $stmt->execute([$boardID]);
    }

    public function deletePieceByID($pieceID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pieces WHERE ID = ?");
        return $stmt->execute([$pieceID]);
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

    public function fetchPieceByPosition($boardID, $position_y, $position_x)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pieces WHERE boardID = ? AND position_y = ? AND position_x = ?");
        $stmt->execute([$boardID, $position_y, $position_x]);
        return $stmt->fetch();
    }

    public function updatePiecePosition($boardID, $old_y, $old_x, $position_y, $position_x)
    {
        $stmt = $this->pdo->prepare("UPDATE pieces SET position_y = ?, position_x = ? WHERE boardID = ? AND position_y = ? AND position_x = ?");
        return $stmt->execute([$position_y, $position_x, $boardID, $old_y, $old_x]);
    }
}
