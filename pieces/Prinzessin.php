<?php
class Prinzessin extends GenericPiece
{
  public function __construct($color, $position_y, $position_x)
  {
    parent::__construct($color, $position_y, $position_x, [
      [[1, 0], [2, 0]],
      [[1, -1], [2, -2]],
      [[1, 1], [2, 2]],
      [[-1, 0], [-2, 0]],
      [[-1, -1], [-2, -2]],
      [[-1, 1], [-2, 2]],
      [[0, 1], [0, 2]],
      [[0, -1], [0, -2]]
    ], "./images/" . $color . "/prinzessin.png");
  }
}
