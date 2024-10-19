<?php

namespace App\Oop;

abstract class Book{ 
  private string $name;
  private string $isbn;
  private array $authors = [];
  private string $preview;
  private int $issueYear;
  private int $shelfId;

public function __construct(string $name, string $isbn, array $authors, string $preview, int $issueYear, int $shelfId){
  $this->name = $name;
  $this->isbn = $isbn;
  $this->authors = $authors;
  $this->preview = $preview;
  $this->issueYear = $issueYear;
  $this->shelfId = $shelfId;
}

public function getName():string {
  return $this->name;
}

public function getAuthors(): array {
  return $this->authors;
}
public function getShelfId(): int {
  return $this->shelfId;
}

abstract public function getBook();

}