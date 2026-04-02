<?php
class GenericPiece
{
    protected $color;
    protected $position_y;
    protected $position_x;
    protected $moveSet = [];
    protected $img;

    public function __construct($color, $position_y, $position_x, $moveSet, $img)
    {
        $this->color = $color;
        $this->position_y = $position_y;
        $this->position_x = $position_x;
        $this->moveSet = $moveSet;
        $this->img = $img;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getPosition()
    {
        return [$this->position_y, $this->position_x];
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

                // Out of bounds check
                if ($this->checkOutOfBounds($newY, $newX)) {
                    continue 2;
                }

                // Piece check
                if (isset($_SESSION['board'][$newY][$newX])) {
                    if ($_SESSION['board'][$newY][$newX]->getColor() !== $this->color) {
                        array_push($captureMoves, [$newY, $newX]);
                    } else {
                        array_push($blockedMoves, [$newY, $newX]);
                    }
                    continue 2;
                }

                array_push($validMoves, [$newY, $newX]);
            }
        }

        return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
    }

    protected function checkOutOfBounds($y, $x)
    {
        return $y < 0 || $y > 7 || $x < 0 || $x > 7;
    }
}
