<?php

namespace App\Oop;

class Shelf {
  private int $shelfId;
  private array $books;
  private int $roomId;
  private int $volume;

  public function __construct(int $shelfId, array $books, int $roomId, int $volume){
    $this->shelfId = $shelfId;
    $this->books = $books;
    $this->roomId = $roomId;
    $this->volume = $volume;
  }
}