<?php
class Thomas extends GenericPiece
{
    public function __construct($color, $position_y, $position_x)
    {
        parent::__construct($color, $position_y, $position_x, [
            [[-1, 0]],
            [[-2, 0]],
        ], "./images/" . $color . "/thomas.png");
    }

    public function getValidMoves()
    {
        $validMoves = [];
        $captureMoves = [];
        $blockedMoves = [];

        foreach ($this->moveSet as $direction) {
            foreach ($direction as $move) {
                if ($this->color === 'black') {
                    $move[0] = -$move[0];
                    $move[1] = -$move[1];
                }

                $newY = $this->position_y + $move[0];
                $newX = $this->position_x + $move[1];

                if ($this->checkOutOfBounds($newY, $newX)) {
                    continue;
                }

                // Check for normal move (1 field forward)
                if (abs($move[0]) === 1) {

                    // Check if the cell in front is blocked
                    if (isset($_SESSION['board'][$newY][$newX])) {
                        array_push($blockedMoves, [$newY, $newX]);
                        continue 2;
                    }

                    // If all checks passed, add the move
                    array_push($validMoves, [$newY, $newX]);
                    continue 2;
                }

                // Check for capture move (2 fields forward)
                if (abs($move[0]) === 2) {

                    // Check if cell is empty
                    if (!isset($_SESSION['board'][$newY][$newX])) {
                        continue 2;
                    }

                    // Check if cell has own piece
                    if ($_SESSION['board'][$newY][$newX]->getColor() === $this->color) {
                        array_push($blockedMoves, [$newY, $newX]);
                        continue 2;
                    }

                    array_push($captureMoves, [$newY, $newX]);
                }
            }
        }

        return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
    }
}