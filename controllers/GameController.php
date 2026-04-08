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
            case 'movePiece':
                $this->handleMovePiece();
                break;
            case 'capturePiece':
                $this->handleCapturePiece();
                break;
        }
    }

    public function handleCreateGame()
    {
        $userID = $_SESSION['user']['ID'] ?? null;

        // Zufällig Farbe zuweisen
        $colors = ['white', 'black'];
        $assignedColor = $colors[array_rand($colors)];

        if ($assignedColor === 'white') {
            $playerWhiteID = $userID;
            $playerBlackID = null;
        } else {
            $playerWhiteID = null;
            $playerBlackID = $userID;
        }

        $this->gameModel->insertBoard($playerWhiteID, $playerBlackID);

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

        // For testing purposes only:
        $this->gameModel->insertPiece($boardID, "pony", "white", 5, 4);
        $this->gameModel->insertPiece($boardID, "pony", "black", 5, 3);
        $this->gameModel->insertPiece($boardID, "gazelle", "white", 4, 4);
        $this->gameModel->insertPiece($boardID, "prinzessin", "black", 3, 3);

        $this->handleJoinGame($boardID);
    }

    public function handleJoinGame($boardID = null)
    {
        if ($boardID === null) {
            $boardID = $_POST['boardID'] ?? null;
        }

        unset($_SESSION['board']);
        unset($_SESSION['validMoves']);
        unset($_SESSION['captureMoves']);
        unset($_SESSION['blockedMoves']);
        unset($_SESSION['selectedPiece']);

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

        // Check for open player slot and set Players ID
        if ($board['playerWhiteID'] === null && $board['playerBlackID'] != $_SESSION['user']['ID']) {
            $this->gameModel->updateBoardPlayerWhite($boardID, $_SESSION['user']['ID']);
            $_SESSION['board']['playerWhiteID'] = $_SESSION['user']['ID'];
            $_SESSION['board']['playerBlackID'] = $board['playerBlackID'];
        } elseif ($board['playerBlackID'] === null && $board['playerWhiteID'] != $_SESSION['user']['ID']) {
            $this->gameModel->updateBoardPlayerBlack($boardID, $_SESSION['user']['ID']);
            $_SESSION['board']['playerWhiteID'] = $board['playerWhiteID'];
            $_SESSION['board']['playerBlackID'] = $_SESSION['user']['ID'];
        } else {
            $_SESSION['board']['playerWhiteID'] = $board['playerWhiteID'];
            $_SESSION['board']['playerBlackID'] = $board['playerBlackID'];
        }

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
                case 'gazelle':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Gazelle($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case "confusedPawn":
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new ConfusedPawn($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case "prinzessin":
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Prinzessin($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case "pony":
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Pony($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
                case 'thomas':
                    $_SESSION['board'][$piece['position_y']][$piece['position_x']] = new Thomas($piece['color'], $piece['position_y'], $piece['position_x']);
                    break;
            }
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=board');
        exit();
    }

    public function handleSelectCell()
    {
        if (!$this->checkPlayersTurn()) {
            return;
        }

        $y = $_POST['y'] ?? null;
        $x = $_POST['x'] ?? null;

        if ($y === null || $x === null) {
            return;
        }

        if (!isset($_SESSION['board'][$y][$x]) || !$_SESSION['board'][$y][$x]) {
            return;
        }

        if ($_SESSION['selectedPiece'] === [intval($y), intval($x)]) {
            unset($_SESSION['validMoves']);
            unset($_SESSION['captureMoves']);
            unset($_SESSION['blockedMoves']);
            unset($_SESSION['selectedPiece']);

            header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=board');
            exit();
        }

        $piece = $_SESSION['board'][$y][$x];

        $validMoves = $piece->getValidMoves($_SESSION['board']);

        $_SESSION['validMoves'] = $validMoves['validMoves'];
        $_SESSION['captureMoves'] = $validMoves['captureMoves'];
        $_SESSION['blockedMoves'] = $validMoves['blockedMoves'];
        $_SESSION['selectedPiece'] = $piece->getPosition();

        header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=board');
        exit();
    }

    public function handleMovePiece()
    {
        if (!$this->checkPlayersTurn()) {
            return;
        }

        $y = $_POST['y'] ?? null;
        $x = $_POST['x'] ?? null;

        if ($y === null || $x === null) {
            return;
        }

        // Check if a piece is selected
        if (!isset($_SESSION['selectedPiece']) || !$_SESSION['selectedPiece']) {
            return;
        }

        $selectedY = $_SESSION['selectedPiece'][0];
        $selectedX = $_SESSION['selectedPiece'][1];

        // Check if the move is valid
        if (!isset($_SESSION['validMoves']) || !in_array([$y, $x], $_SESSION['validMoves'])) {
            return;
        }

        // Update the piece position in the database
        $boardID = $_SESSION['board']['boardID'];
        $this->gameModel->updatePiecePosition($boardID, $selectedY, $selectedX, $y, $x);

        // Update turn in the database
        $turn = $this->gameModel->getBoardTurn($boardID);
        $newTurn = ($turn === 'white') ? 'black' : 'white';
        $this->gameModel->setBoardTurn($boardID, $newTurn);

        // Move the piece in the session
        $_SESSION['board'][$y][$x] = $_SESSION['board'][$selectedY][$selectedX];
        $_SESSION['board'][$y][$x]->setPosition($y, $x);
        $_SESSION['board'][$selectedY][$selectedX] = null;

        unset($_SESSION['validMoves']);
        unset($_SESSION['captureMoves']);
        unset($_SESSION['blockedMoves']);
        unset($_SESSION['selectedPiece']);

        header('Location: ' . $_SERVER['PHP_SELF'] . '?nav=board');
        exit();
    }

    public function handleCapturePiece()
    {
        if (!$this->checkPlayersTurn()) {
            return;
        }

        $y = $_POST['y'] ?? null;
        $x = $_POST['x'] ?? null;

        if ($y === null || $x === null) {
            return;
        }

        // Check if a piece is selected
        if (!isset($_SESSION['selectedPiece']) || !$_SESSION['selectedPiece']) {
            return;
        }

        $selectedY = $_SESSION['selectedPiece'][0];
        $selectedX = $_SESSION['selectedPiece'][1];

        // Check if the capture move is valid
        if (!isset($_SESSION['captureMoves']) || !in_array([$y, $x], $_SESSION['captureMoves'])) {
            return;
        }

        // Delete captured piece from the database
        $boardID = $_SESSION['board']['boardID'];
        $pieceID = $this->gameModel->fetchPieceByPosition($boardID, $y, $x)['ID'];
        $this->gameModel->deletePieceByID($pieceID);

        // Update the piece position in the database
        $boardID = $_SESSION['board']['boardID'];
        $this->gameModel->updatePiecePosition($boardID, $selectedY, $selectedX, $y, $x);

        // Update turn in the database
        $turn = $this->gameModel->getBoardTurn($boardID);
        $newTurn = ($turn === 'white') ? 'black' : 'white';
        $this->gameModel->setBoardTurn($boardID, $newTurn);

        // Capture the piece in the session
        $_SESSION['board'][$y][$x] = $_SESSION['board'][$selectedY][$selectedX];
        $_SESSION['board'][$y][$x]->setPosition($y, $x);
        $_SESSION['board'][$selectedY][$selectedX] = null;

        unset($_SESSION['validMoves']);
        unset($_SESSION['captureMoves']);
        unset($_SESSION['blockedMoves']);
        unset($_SESSION['selectedPiece']);

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

    public function getEmptyGames()
    {
        $games = $this->gameModel->fetchEmptyBoards();

        return $games;
    }

    public function checkPlayersTurn()
    {
        if (!isset($_SESSION['user']['ID']) || empty($_SESSION['user']['ID'])) {
            return false;
        }

        if (!isset($_SESSION['board']['boardID']) || empty($_SESSION['board']['boardID'])) {
            return false;
        }

        $userID = $_SESSION['user']['ID'] ?? null;
        $boardID = $_SESSION['board']['boardID'] ?? null;

        $board = $this->gameModel->fetchBoard($boardID);
        $turn = $board['turn'];

        if (($turn === 'white' && $userID === $board['playerWhiteID']) || ($turn === 'black' && $userID === $board['playerBlackID'])) {
            return true;
        }

        return false;
    }

    public function checkPlayerWhite()
    {
        if (!isset($_SESSION['user']['ID']) || empty($_SESSION['user']['ID'])) {
            return false;
        }

        if (!isset($_SESSION['board']['boardID']) || empty($_SESSION['board']['boardID'])) {
            return false;
        }

        $userID = $_SESSION['user']['ID'] ?? null;
        $boardID = $_SESSION['board']['boardID'] ?? null;

        $board = $this->gameModel->fetchBoard($boardID);

        if ($userID === $board['playerWhiteID']) {
            return true;
        }

        return false;
    }

    public function checkPlayerBlack()
    {
        if (!isset($_SESSION['user']['ID']) || empty($_SESSION['user']['ID'])) {
            return false;
        }

        if (!isset($_SESSION['board']['boardID']) || empty($_SESSION['board']['boardID'])) {
            return false;
        }

        $userID = $_SESSION['user']['ID'] ?? null;
        $boardID = $_SESSION['board']['boardID'] ?? null;

        $board = $this->gameModel->fetchBoard($boardID);

        if ($userID === $board['playerBlackID']) {
            return true;
        }

        return false;
    }

    public function getBoardTurn()
    {
        if (!isset($_SESSION['board']['boardID']) || empty($_SESSION['board']['boardID'])) {
            return;
        }

        $boardID = $_SESSION['board']['boardID'] ?? null;

        $turn = $this->gameModel->getBoardTurn($boardID);

        return $turn;
    }
}
