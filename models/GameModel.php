<?php
class BoardModel
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertBoard($player1, $player2) {
    }

    public function fetchBoard($boardID) {

    }

    public function insertPiece($boardID, $type, $color, $positon_x, $position_y) {
        
    }

    public function fetchPieces($boardID) {

    }
}