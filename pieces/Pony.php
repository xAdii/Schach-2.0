<?php
class Pony extends GenericPiece
{
  public function __construct($color, $position_y, $position_x)
  {
    parent::__construct($color, $position_y, $position_x, [
      [[-2, 0]],
      [[-0, -2]],
      [[0, 2]],
      [[2, 0]],
    ], "./images/" . $color . "/pony.png");
  }
}
