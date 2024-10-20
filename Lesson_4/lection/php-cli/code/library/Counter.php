<?php

namespace App\Oop;

class Counter {
  private int $count;

  public function __construct(){
    $this->count;
  }

  public function getCounter(): int{
    return $this->count;
  }

  public function setCounter(int $value): void {
    $this->count += $value;
  }

  public function counterIncrement(): void{
    $this->count = $this->setCounter(1);
  }
}