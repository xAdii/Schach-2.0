<?php
class Pawn extends GenericPiece
{
  public function __construct($color, $position_y, $position_x)
  {
    parent::__construct($color, $position_y, $position_x, [
      [[-1, 0]],
      [[-2, 0]],
      [[-1, -1]],
      [[-1, 1]]
    ], "./images/" . $color . "/pawn.png");
  }

  public function getValidMoves()
  {
    $validMoves = [];

    foreach ($this->moveSet as $direction) {
      foreach ($direction as $move) {
        if ($this->color === 'black') {
          $move[0] = -$move[0];
          $move[1] = -$move[1];
        }

        $newY = $this->position_y + $move[0];
        $newX = $this->position_x + $move[1];

        if ($this->checkOutOfBounds($newY, $newX)) {
          continue;
        }

        // Check for normal move
        if ($move[1] === 0 ) {
          
          // Check if the cell in front is empty
          if (isset($_SESSION['board'][$newY][$newX])) {
            continue;
          }

          // Check for first move
          if (abs($move[0]) === 2) {

            // Check if step in front is empty
            if (isset($_SESSION['board'][$this->position_y + ($move[0] / 2)][$newX])) {
              continue;
            }
            // Check if piece is on its starting position
            if ($this->color === 'white' && $this->position_y !== 6) {
              continue;
            }
            if ($this->color === 'black' && $this->position_y !== 1) {
              continue;
            }
          }

          // If all checks passed, add the move
          array_push($validMoves, [$newY, $newX]);
        }

        // Check for capture move
        if ($move[1] !== 0) {

          // Check if cell is empty
          if (!isset($_SESSION['board'][$newY][$newX])) {
            continue;
          }

          // Check if cell has opponent piece
          if ($_SESSION['board'][$newY][$newX]->getColor() === $this->color) {
            continue;
          }

          array_push($validMoves, [$newY, $newX]);
        }
      }
    }

    return $validMoves;
  }
}
