<?php
class GenericPiece
{
    protected $color;
    protected $position_y;
    protected $position_x;

    public function __construct($color, $position_y, $position_x)
    {
        $this->color = $color;
        $this->position_y = $position_y;
        $this->position_x = $position_x;
    }

    public function move($board, $newPosition) {}
}
