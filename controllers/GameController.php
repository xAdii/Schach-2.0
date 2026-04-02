<?php
class GameController
{
    private $gameModel;

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
            case 'deleteGame':
                $this->handleDeleteGame();
                break;
            case 'selectCell':
                $this->handleSelectCell();
                break;
        }
    }

    public function handleCreateGame()
    {
        $userID = $_SESSION['user']['ID'] ?? null;

        $this->gameModel->insertBoard($userID, $userID);

        $boardID = $this->gameModel->fetchMaxBoardID()['ID'];

        $this->gameModel->insertPiece($boardID, "rook", "white", 7, 0);
        $this->gameModel->insertPiece($boardID, "knight", "white", 7, 1);
        $this->gameModel->insertPiece($boardID, "bishop", "white", 7, 2);
        $this->gameModel->insertPiece($boardID, "queen", "white", 7, 3);
        $this->gameModel->insertPiece($boardID, "king", "white", 7, 4);
        $this->gameModel->insertPiece($boardID, "bishop", "white", 7, 5);
        $this->gameModel->insertPiece($boardID, "knight", "white", 7, 6);
        $this->gameModel->insertPiece($boardID, "rook", "white", 7, 7);

        for ($i = 0; $i < 8; $i++) {
            $this->gameModel->insertPiece($boardID, "pawn", "white", 6, $i);
        }

        $this->gameModel->insertPiece($boardID, "rook", "black", 0, 0);
        $this->gameModel->insertPiece($boardID, "knight", "black", 0, 1);
        $this->gameModel->insertPiece($boardID, "bishop", "black", 0, 2);
        $this->gameModel->insertPiece($boardID, "queen", "black", 0, 3);
        $this->gameModel->insertPiece($boardID, "king", "black", 0, 4);
        $this->gameModel->insertPiece($boardID, "bishop", "black", 0, 5);
        $this->gameModel->insertPiece($boardID, "knight", "black", 0, 6);
        $this->gameModel->insertPiece($boardID, "rook", "black", 0, 7);

        for ($i = 0; $i < 8; $i++) {
            $this->gameModel->insertPiece($boardID, "pawn", "black", 1, $i);
        }

        $this->handleJoinGame($boardID);
    }

    public function handleJoinGame($boardID = null)
    {
        if ($boardID === null) {
            $boardID = $_POST['boardID'] ?? null;
        }

        unset($_SESSION['board']);

        unset($_SESSION['validMoves']);

        $_SESSION['board'] = [
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            []
        ];

        $board = $this->gameModel->fetchBoard($boardID);
        $_SESSION['board']['boardID'] = $board['ID'];
        $_SESSION['board']['playerWhiteID'] = $board['playerWhiteID'];
        $_SESSION['board']['playerBlackID'] = $board['playerBlackID'];

        $pieces = $this->gameModel->fetchPieces($boardID);
        foreach ($pieces as $piece) {
            switch ($piece['type']) {
                case 'pawn':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Pawn($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'rook':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Rook($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'knight':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Knight($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'bishop':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Bishop($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'queen':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Queen($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'king':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new King($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
            }
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=board');
        exit();
    }

    public function handleSelectCell()
    {
        $y = $_POST['y'] ?? null;
        $x = $_POST['x'] ?? null;

        if ($y === null || $x === null) {
            return;
        }

        if (!isset($_SESSION['board'][$y][$x]) || !$_SESSION['board'][$y][$x]) {
            return;
        }

        $piece = $_SESSION['board'][$y][$x];

        $validMoves = $piece->getValidMoves($_SESSION['board']);

        $_SESSION['validMoves'] = $validMoves;

        header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=board');
        exit();
    }

    public function handleDeleteGame()
    {
        $boardID = $_POST['boardID'] ?? null;

        $this->gameModel->deletePiecesByBoardID($boardID);
        $this->gameModel->deleteBoard($boardID);

        header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=play');
        exit();
    }

    public function getUserGames()
    {
        if (!isset($_SESSION['user']['ID']) || empty($_SESSION['user']['ID'])) {
            return;
        }

        $userID = $_SESSION['user']['ID'] ?? null;

        $games = $this->gameModel->fetchBoardsByUserID($userID);

        return $games;
    }
}