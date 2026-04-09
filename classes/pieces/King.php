<?php
class King extends GenericPiece
{
  public function __construct($color, $position_y, $position_x)
  {
    parent::__construct($color, $position_y, $position_x, [
      [[-1, -1]],
      [[-1,  0]],
      [[-1,  1]],
      [[0, -1]],
      [[0,  1]],
      [[1, -1]],
      [[1,  0]],
      [[1,  1]]
    ], "./images/" . $color . "/king.png");
  }
}
