<?php
class Schachfigur
{
    protected $color;
    protected $position;

    public function __construct($color, $position)
    {
        $this->color = $color;
        $this->position = $position;
    }

    public function move($board, $newPosition) {}
}