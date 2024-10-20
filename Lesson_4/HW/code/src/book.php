<?php
namespace App\dz;

abstract class Book{ 
  private string $name;
  private string $author;
  private int $issueYear;
  private string $address;

public function __construct($name, $author, $issueYear, $address){
  $this->name = $name;
  $this->author = $author;
  $this->issueYear = $issueYear;
  $this->address = $address;
}

public function getName():string {
  return $this->name;
}

public function getAuthor(): string {
  return $this->author;
}
public function getAddress(): string {
  return $this->address;
}

public function __toString()
{
  return "Книга: " . $this->name . ", Автора: " . $this->author . ", год издания: " . $this->issueYear;
}

abstract public function getBook();

}