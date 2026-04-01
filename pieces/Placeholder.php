<?php
class Placeholder extends GenericPiece
{
    private $moveSet = [
        [-1, 0],
        [1, 0]
    ];

    private $img;

    public function __construct($color, $position)
    {
        parent::__construct($color, $position);
        $this->img = $color === 'black' ? './images/placeholder_black.png' : './images/placeholder.png';
    }

    public function getValidMoves($board)
    {
        $validMoves = [];

        foreach ($this->moveSet as $move) {
            $newPosition = [
                $this->position[0] + $move[0],
                $this->position[1] + $move[1]
            ];

            if ($newPosition[0] < 0 || $newPosition[0] > 7 || $newPosition[1] < 0 || $newPosition[1] > 7) {
                continue;
            }

            array_push($validMoves, $move);
        }
    }

    public function getImg()
    {
        return $this->img;
    }
}
