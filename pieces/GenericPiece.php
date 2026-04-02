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

    public function getValidMoves($board)
    {
        $validMoves = [];

        foreach ($this->moveSet as $move) {
            $newPosition = [
                $this->position_y + $move[0],
                $this->position_x + $move[1]
            ];

            if ($newPosition[0] < 0 || $newPosition[0] > 7 || $newPosition[1] < 0 || $newPosition[1] > 7) {
                continue;
            }

            array_push($validMoves, $move);
        }
        return $validMoves;
    }

    public function move($board, $newPosition) {}
}
