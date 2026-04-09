<?php
class Gazelle extends GenericPiece
{
  public function __construct($color, $position_y, $position_x)
  {
    parent::__construct($color, $position_y, $position_x, [
      [[-2, -1]],
      [[-2, 0]],
      [[-2, 1]],
      [[-1, -2]],
      [[-0, -2]],
      [[1, -2]],
      [[-1, 2]],
      [[0, 2]],
      [[1, 2]],
      [[2, 1]],
      [[2, 0]],
      [[2, -1]]
    ], "./images/" . $color . "/gazelle.png");
  }
}
