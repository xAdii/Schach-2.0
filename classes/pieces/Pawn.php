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
    $captureMoves = [];
    $blockedMoves = [];

    foreach ($this->moveSet as $direction) {
      foreach ($direction as $move) {
        if ($this->color === 'black') {
          $move[0] = -$move[0];
        }

        $newY = $this->position_y + $move[0];
        $newX = $this->position_x + $move[1];

        if ($this->checkOutOfBounds($newY, $newX)) {
          continue;
        }

        // Check for normal move
        if ($move[1] === 0) {

          // Check for first move
          if (abs($move[0]) === 2) {

            // Check if step in front is blocked
            if (isset($_SESSION['board'][$this->position_y + ($move[0] / 2)][$newX])) {
              array_push($blockedMoves, [$this->position_y + ($move[0] / 2), $newX]);
              continue 2;
            }
            // Check if piece is on its starting position
            if ($this->color === 'white' && $this->position_y !== 6) {
              continue 2;
            }
            if ($this->color === 'black' && $this->position_y !== 1) {
              continue 2;
            }
          }

          // Check if the cell in front is blocked
          if (isset($_SESSION['board'][$newY][$newX])) {
            array_push($blockedMoves, [$newY, $newX]);
            continue 2;
          }

          // If all checks passed, add the move
          array_push($validMoves, [$newY, $newX]);
        }

        // Check for capture move
        if ($move[1] !== 0) {

          // Check if cell is empty
          if (!isset($_SESSION['board'][$newY][$newX])) {
            continue 2;
          }

          // Check if cell has own piece
          if ($_SESSION['board'][$newY][$newX]->getColor() === $this->color) {
            array_push($blockedMoves, [$newY, $newX]);
            continue 2;
          }

          array_push($captureMoves, [$newY, $newX]);
        }
      }
    }

    return ['validMoves' => $validMoves, 'captureMoves' => $captureMoves, 'blockedMoves' => $blockedMoves];
  }
}
