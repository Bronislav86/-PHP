<?php

namespace App\Oop;

class DigitalBook extends Book {
  private string $link;
  private string $text;

  public function __construct(string $name, string $isbn, array $authors, int $pagesCount, string $preview, int $issueYear, int $shelfId, string $link, string $text){
    parent::__construct($name, $isbn, $authors, $pagesCount, $preview, $issueYear, $shelfId, $link, $text);
    $this->link = $link;
    $this->text = $text;
  }

  public function getBook(string $name = "", string $author = "") : string{
    if ($name === $this->getName()) {
      return $this->link;
    }
    if (in_array($author, $this->getAuthors())) {
      return $this->link;
    }
    return "Подходящей книги нет";
  }

}