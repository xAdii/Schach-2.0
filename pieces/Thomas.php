<?php
class Thomas extends GenericPiece
{
    public function __construct($color, $position_y, $position_x)
    {
        $imgName = $color === 'white' ? 'thomas.png' : 'thomas.png';

        parent::__construct($color, $position_y, $position_x, [], "./images/" . $color . "/" . $imgName);
    }

    public function getValidMoves()
    {
        $validMoves = [];
        $captureMoves = [];
        $blockedMoves = [];

        $forwardStep = $this->color === 'black' ? 1 : -1;
        $x = $this->position_x;
        $oneStepY = $this->position_y + $forwardStep;
        $twoStepY = $this->position_y + ($forwardStep * 2);

        if ($this->checkOutOfBounds($oneStepY, $x)) {
            return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
        }

        $oneStepOccupied = isset($_SESSION['board'][$oneStepY][$x]);

        if ($oneStepOccupied) {
            $blockedMoves[] = [$oneStepY, $x];
            return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
        }

        $validMoves[] = [$oneStepY, $x];

        if (!$this->checkOutOfBounds($twoStepY, $x) && isset($_SESSION['board'][$twoStepY][$x])) {
            if ($_SESSION['board'][$twoStepY][$x]->getColor() !== $this->color) {
                $captureMoves[] = [$twoStepY, $x];
            } else {
                $blockedMoves[] = [$twoStepY, $x];
            }
        }

        return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
    }
}
