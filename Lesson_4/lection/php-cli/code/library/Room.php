<?php
namespace App\Oop;

class Room {
  private int $roomId;
  private string $address;

  public function __construct(int $roomId, string $address){
    $this->roomId = $roomId;
    $this->address = $address;
  }
}