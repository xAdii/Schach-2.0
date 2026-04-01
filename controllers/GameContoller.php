<?php
class GameController
{
    private $gameModel;
    private $board = [];

    public function __construct($gameModel)
    {
        $this->gameModel = $gameModel;
    }

    public function handleRequest()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        // Check if user is logged in
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            return;
        }

        // Validate action
        if (!isset($_POST['action']) || empty($_POST['action'])) {
            return;
        }

        switch ($_POST['action']) {
            case 'createGame':
                $this->handleCreateGame();
                break;
            case 'joinGame':
                $this->handleJoinGame();
                break;
        }
    }

    public function handleCreateGame()
    {
        if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
            return;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        $this->gameModel->insertBoard($userID, $userID);

        $boardID = $this->gameModel->fetchMaxBoardID();

        $this->gameModel->insertPiece($boardID, "rook", "white", 0, 0);
        $this->gameModel->insertPiece($boardID, "knight", "white", 0, 1);
        $this->gameModel->insertPiece($boardID, "bishop", "white", 0, 2);
        $this->gameModel->insertPiece($boardID, "queen", "white", 0, 3);
        $this->gameModel->insertPiece($boardID, "king", "white", 0, 4);
        $this->gameModel->insertPiece($boardID, "bishop", "white", 0, 5);
        $this->gameModel->insertPiece($boardID, "knight", "white", 0, 6);
        $this->gameModel->insertPiece($boardID, "rook", "white", 0, 7);

        for ($i = 0; $i < 8; $i++) {
            $this->gameModel->insertPiece($boardID, "pawn", "white", 1, $i);
        }

        $this->gameModel->insertPiece($boardID, "rook", "black", 7, 0);
        $this->gameModel->insertPiece($boardID, "knight", "black", 7, 1);
        $this->gameModel->insertPiece($boardID, "bishop", "black", 7, 2);
        $this->gameModel->insertPiece($boardID, "queen", "black", 7, 3);
        $this->gameModel->insertPiece($boardID, "king", "black", 7, 4);
        $this->gameModel->insertPiece($boardID, "bishop", "black", 7, 5);
        $this->gameModel->insertPiece($boardID, "knight", "black", 7, 6);
        $this->gameModel->insertPiece($boardID, "rook", "black", 7, 7);

        for ($i = 0; $i < 8; $i++) {
            $this->gameModel->insertPiece($boardID, "pawn", "black", 6, $i);
        }

        $this->handleJoinGame($boardID);
    }

    public function handleJoinGame($boardID = null)
    {
        if ($boardID === null) {
            if (!isset($_POST['boardID']) || empty($_POST['boardID'])) {
                return;
            }
            $boardID = $_POST['boardID'];
        }

        $this->board = [];

        $board = $this->gameModel->fetchBoard($boardID);

        $pieces = $this->gameModel->fetchPieces($boardID);

        foreach ($pieces as $piece) {
            switch ($piece['type']) {
                case 'pawn':
                    $this->board[$piece['position_y']][$piece['position_x']] = new Pawn($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'rook':
                    $this->board[$piece['position_y']][$piece['position_x']] = new Rook($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'knight':
                    $this->board[$piece['position_y']][$piece['position_x']] = new Knight($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'bishop':
                    $this->board[$piece['position_y']][$piece['position_x']] = new Bishop($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'queen':
                    $this->board[$piece['position_y']][$piece['position_x']] = new Queen($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'king':
                    $this->board[$piece['position_y']][$piece['position_x']] = new King($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
            }
        }
    }

    public function getUserGames()
    {
        if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
            return;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        $games = $this->gameModel->fetchBoardsByUserID($userID);

        return $games;
    }
}
