<?php
class King extends GenericPiece
{
  private $moveSet = [
    [-1, -1],
    [-1, 0],
    [-1, 1],
    [0, -1],
    [0, 1],
    [1, -1],
    [1, 0],
    [1, 1]
  ];

  private $img;

  public function __construct($color, $position_y, $position_x)
  {
    parent::__construct($color, $position_y, $position_x);
    $this->img = "./images/" . $color . "/king.png";
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

  public function getImg()
  {
    return $this->img;
  }
}
