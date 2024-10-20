<?php
namespace App\dz;


class Counter {
  private int $count;

  public function __construct(){
    $this->count = 0;
  }

  public function getCounter(): int{
    return $this->count;
  }

  public function counterIncrement(): void{
    $this->count += 1;
  }
}