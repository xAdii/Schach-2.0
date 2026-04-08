<?php
class Thomas extends GenericPiece
{
    public function __construct($color, $position_y, $position_x)
    {
        $imgName = $color === 'white' ? 'thomas-white-v2.png' : 'thomas-black-v2.png';

        parent::__construct($color, $position_y, $position_x, [], "./images/" . $color . "/" . $imgName);
    }

    public function getValidMoves()
    {
        $validMoves = [];
        $captureMoves = [];
        $blockedMoves = [];

        $forwardStep = $this->color === 'black' ? 1 : -1;

        $oneStepY = $this->position_y + $forwardStep;
        $twoStepY = $this->position_y + ($forwardStep * 2);
        $x = $this->position_x;

        if (!$this->checkOutOfBounds($oneStepY, $x)) {
            if (isset($_SESSION['board'][$oneStepY][$x])) {
                $blockedMoves[] = [$oneStepY, $x];
            } else {
                $validMoves[] = [$oneStepY, $x];

                if (!$this->checkOutOfBounds($twoStepY, $x) && isset($_SESSION['board'][$twoStepY][$x])) {
                    if ($_SESSION['board'][$twoStepY][$x]->getColor() !== $this->color) {
                        $captureMoves[] = [$twoStepY, $x];
                    } else {
                        $blockedMoves[] = [$twoStepY, $x];
                    }
                }
            }
        }

        return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
    }
}
