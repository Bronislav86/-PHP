<?php
namespace App\dz;


class DigitalBook extends Book {
  private string $link;
  private static Counter $countOfIss;

  public function __construct($name, $author, $issueYear, $address, $link){
    parent::__construct($name, $author, $issueYear, $address);
    $this->link = $link;
    self::$countOfIss = new Counter();
  }

  public function getBookIssues(): int {
    return self::$countOfIss->getCounter();
  }

  public function getBook(string $name = "", string $author = "") : string{
    if ($name == $this->getName()) {
      DigitalBook::$countOfIss->counterIncrement();
      return $this->__toString() . " может быть скачена по адресу: " . $this->link;
    }
    if ($author == $this->getAuthor()) {
      DigitalBook::$countOfIss->counterIncrement();
      return $this->__toString() . " может быть скачена по адресу: " . $this->link;
    }
    return "Подходящей книги нет";
  }

}
