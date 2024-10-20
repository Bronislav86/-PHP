<?php

namespace code;

interface IProduct{

  public function gteFinalCost(): float;

}

abstract class Good implements IProduct{
  protected string $name;
  protected int $cost;

  public function __construct(string $name, int $cost){
    $this->name = $name;
    $this->cost = $cost;
  }

}

class phisicalGood extends Good {
  protected int $quantity;

  public function __construct (string $name, int $cost, int $quantity){
    parent::__construct($name, $cost);
    $this->quantity = $quantity;
  }


  public function gteFinalCost(): float{
    return $this->cost * $this->quantity;
  }

}

class digitalGood extends phisicalGood {
  protected string $url;

  public function __construct (string $name, int $cost, int $quantity, string $url){
    parent::__construct($name, $cost, $quantity);
    $this->url = $url;
  }

  public function gteFinalCost(): float{
    return $this->cost * $this->quantity * 0.5;
  }
}

class WeightGood extends Good {
  protected float $weight;

  public function __construct (string $name, int $cost, float $weight){
    parent::__construct($name, $cost);
    $this->weight = $weight;
  }


  public function gteFinalCost(): float{
    return $this->cost * $this->weight;
  }
}

$good1 = new digitalGood('Apple', 150, 20, 'www.apple.com');
echo $good1->gteFinalCost() . PHP_EOL;
$good1 = new phisicalGood('Stone', 150, 20);
echo $good1->gteFinalCost() . PHP_EOL;